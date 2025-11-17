<?php

namespace App\Services;

use App\Models\Abonnement;
use App\Models\Caisse;
use App\Models\Paiement;
use App\Models\PaiementSemaine;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentRecordingService
{
    /**
     * Enregistre un paiement administrateur pour un utilisateur.
     *
     * @param string $userId
     * @param float|int $montant Montant versé (ex: 500.00)
     * @param Carbon|null $date Optionnel : date d'enregistrement (par défaut now)
     * @return Paiement
     *
     * @throws \Exception
     */
    public function record(string $userId, $montant, ?Carbon $date = null): ?Paiement
    {
        try{
        $date = $date ? $date->copy() : Carbon::now();
        $montant = round((float)$montant, 2);

        return DB::transaction(function () use ($userId, $montant, $date) {
            // 1) Charger user + abonnement (verrouillé pour update to prevent races)
            $user = User::find($userId);
            if (! $user) {
                throw new ModelNotFoundException("Utilisateur introuvable: {$userId}");
            }

            $abonnement = Abonnement::where('users_id', $userId)->lockForUpdate()->first();
            if (! $abonnement) {
                throw new ModelNotFoundException("Abonnement introuvable pour l'utilisateur: {$userId}");
            }

            $montantParSemaine = (float) $abonnement->montant_par_semaine;

            // 2) Créer le Paiement (initial)
            $paiement = Paiement::create([
                'users_id' => $userId,
                'montant' => $montant,
                'weeks_covered' => 0,      // update après allocation
                'reste_a_payer' => null,   // update après allocation
                'status' => 'recorded',
                'commentaire' => 'Paiement enregistré manuellement par admin le ' . $date->toDateTimeString(),
            ]);

            // 3) Récupérer la liste des dimanches attendus (depuis start_date jusqu'à la date de référence)
            $sundays = $this->listSundaysBetween($abonnement->start_date, $date);

            // 4) Déterminer quelles semaines sont déjà couvertes
            $coveredDates = PaiementSemaine::where('users_id', $userId)
                ->whereIn('sunday_date', $sundays)
                ->pluck('sunday_date')
                ->map(function ($d) { return Carbon::parse($d)->toDateString(); })
                ->toArray();

            // 5) Itérer sur les dimanches non couverts (les plus anciens d'abord), allouer le montant
            $remainingToAllocate = $montant;
            $allocatedWeekCount = 0;
            $createdPaiementSemaines = [];

            foreach ($sundays as $sundayDate) {
                $sundayKey = Carbon::parse($sundayDate)->toDateString();
                if (in_array($sundayKey, $coveredDates, true)) {
                    // déjà couvert, on passe
                    continue;
                }

                if ($remainingToAllocate <= 0) {
                    break;
                }

                // si on a assez pour couvrir une semaine pleine
                if ($remainingToAllocate >= $montantParSemaine) {
                    $applique = round($montantParSemaine, 2);
                } else {
                    // paiement partiel pour cette semaine
                    $applique = round($remainingToAllocate, 2);
                }

                $ps = PaiementSemaine::create([
                    'paiements_id' => $paiement->id,
                    'users_id' => $userId,
                    'sunday_date' => $sundayKey,
                    'montant_applique' => $applique,
                ]);

                $createdPaiementSemaines[] = $ps;
                $remainingToAllocate = round($remainingToAllocate - $applique, 2);

                if ($applique >= $montantParSemaine) {
                    $allocatedWeekCount++;
                }

                // si le paiement était partiel (reste < montantParSemaine) on arrête l'assignation semaine
                if ($remainingToAllocate < 0.01) {
                    break;
                }
            }

            // 6) Si après attribution aux semaines dues il reste encore du montant (paiement en avance),
            //    on peut décider de le garder non-alloué aux semaines futures, ou l'allouer aux prochains dimanches futurs.
            //    Ici on choisit d'allouer aussi aux dimanches *futurs* (après $date) si reste > 0.
            if ($remainingToAllocate > 0.009) {
                // chercher dimanches futurs (après $date) jusqu'à ce que montant soit épuisé
                $futureSundays = $this->listSundaysBetween(Carbon::parse($date)->addWeek(), Carbon::parse($date)->addMonths(6)); // plafond 6 mois
                foreach ($futureSundays as $sundayDate) {
                    if ($remainingToAllocate <= 0) break;

                    // skip if already created (unlikely)
                    $exists = PaiementSemaine::where('users_id', $userId)
                        ->where('sunday_date', Carbon::parse($sundayDate)->toDateString())
                        ->exists();
                    if ($exists) continue;

                    if ($remainingToAllocate >= $montantParSemaine) {
                        $applique = round($montantParSemaine, 2);
                    } else {
                        $applique = round($remainingToAllocate, 2);
                    }

                    $ps = PaiementSemaine::create([
                        'paiements_id' => $paiement->id,
                        'users_id' => $userId,
                        'sunday_date' => Carbon::parse($sundayDate)->toDateString(),
                        'montant_applique' => $applique,
                    ]);

                    $createdPaiementSemaines[] = $ps;
                    if ($applique >= $montantParSemaine) {
                        $allocatedWeekCount++;
                    }
                    $remainingToAllocate = round($remainingToAllocate - $applique, 2);
                }
            }

            // 7) Calculer weeks_covered -- on met le nombre de semaines pleines couvertes par ce paiement
            $weeksCovered = (int) floor($montant / $montantParSemaine);

            // 8) Recalculer le reste_a_payer global (expected - totalPaid) jusqu'à la date ($date)
            //    Note: totalPaid inclut ce paiement déjà car on a inséré le paiement plus les paiement_semaines.
            $totalPaid = (float) $user->paiements()->sum('montant');
            $expected = $abonnement->expectedAmount($date);
            $remainingGlobal = max(0, round($expected - $totalPaid, 2));

            // 9) Mettre à jour le paiement
            $paiement->update([
                'weeks_covered' => $weeksCovered,
                'reste_a_payer' => $remainingGlobal,
            ]);

            // 10) Créer la transaction en caisse (entrée)
            Caisse::create([
                'paiements_id' => $paiement->id,
                'montant' => $montant,
                'types' => 'in',
                'description' => "Paiement admin pour user {$userId} - paiements_id {$paiement->id}",
                // balance_after can be computed if you keep a running balance; laissée à NULL si non utilisée
            ]);

            return $paiement;
        }, 5); // retry up to 5 times en cas de deadlock
        }catch(Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Retourne un tableau (string dates Y-m-d) contenant tous les dimanches entre $start (inclus)
     * et $end (inclus). $start peut être une string/date/Carbon.
     *
     * @param string|\DateTime|Carbon $start
     * @param string|\DateTime|Carbon $end
     * @return string[] dates Y-m-d ordonnées asc (anciennes -> récentes)
     */
    protected function listSundaysBetween($start, $end): array
    {
        $start = $start instanceof Carbon ? $start->copy()->startOfDay() : Carbon::parse($start)->startOfDay();
        $end = $end instanceof Carbon ? $end->copy()->startOfDay() : Carbon::parse($end)->startOfDay();

        // Normaliser start pour qu'il soit un dimanche (si ce n'est pas le cas, on avance vers le prochain dimanche <= start)
        if ($start->dayOfWeek !== Carbon::SUNDAY) {
            // si start est après le dimanche, reculer jusqu'au dimanche précédent
            $start = $start->copy()->modify('last sunday');
            // Attention: 'last sunday' retourne le dimanche précédent; si start itself is sunday, above won't run.
        }

        $sundays = [];
        $cursor = $start->copy();
        while ($cursor->lte($end)) {
            $sundays[] = $cursor->toDateString();
            $cursor->addWeek();
        }

        return $sundays;
    }
}
