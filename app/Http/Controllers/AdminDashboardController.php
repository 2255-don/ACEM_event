<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Caisse;
use App\Models\Paiement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        // --- 1) Totaux caisse (entrées - sorties)
        $totalIn = (float) Caisse::where('types', 'in')->sum('montant');
        $totalOut = (float) Caisse::where('types', 'out')->sum('montant');
        $balanceCaisse = round($totalIn - $totalOut, 2);

        // --- 2) Total attendu (somme des expectedAmount pour tous les abonnements)
        // Note : expectedAmount est une méthode sur le model Abonnement
        $abonnements = Abonnement::with('user')->get();
        $totalExpected = 0.0;
        foreach ($abonnements as $ab) {
            $totalExpected += (float) $ab->expectedAmount($now);
        }
        $totalExpected = round($totalExpected, 2);

        // --- 3) Total payé (sommes des paiements)
        $totalPaid = round((float) Paiement::sum('montant'), 2);

        // --- 4) Utilisateurs en retard (remaining > 0)
        // Pour simplicité on calcule via les méthodes du model (attention: N+1 pour beaucoup d'utilisateurs)
        $users = User::with('abonnement')->get();
        $debtors = collect();
        foreach ($users as $u) {
            if (! $u->abonnement) continue;
            $remaining = $u->abonnement->remainingAmount($now);
            if ($remaining > 0.0) {
                $debtors->push([
                    'user_id' => $u->id,
                    'nom' => $u->nom,
                    'prenom' => $u->prenom,
                    'email' => $u->email,
                    'remaining' => $remaining,
                    'total_paid' => $u->abonnement->totalPaid($now),
                    'expected' => $u->abonnement->expectedAmount($now),
                ]);
            }
        }

        $debtors = $debtors->sortByDesc('remaining')->values(); // tri décroissant par dette
        $debtorsCount = $debtors->count();

        // Top 10 débiteurs
        $topDebtors = $debtors->take(10);

        // --- 5) Derniers paiements
        $recentPayments = Paiement::with('user')->orderBy('created_at', 'desc')->take(10)->get();

        // --- 6) Graphique : paiements hebdomadaires (dernières 12 semaines)
        $weeks = 12;
        $labels = [];
        $data = [];

        // Construire 12 étiquettes (début de semaine = dimanche) en ordre asc
        $startOfCurrentWeek = $now->copy()->startOfWeek(Carbon::SUNDAY); // start Sunday
        $start = $startOfCurrentWeek->copy()->subWeeks($weeks - 1);

        for ($i = 0; $i < $weeks; $i++) {
            $weekStart = $start->copy()->addWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SATURDAY); // fin la semaine
            $labels[] = $weekStart->format('Y-m-d');
            $sum = Paiement::whereBetween('created_at', [$weekStart->startOfDay(), $weekEnd->endOfDay()])->sum('montant');
            $data[] = round((float) $sum, 2);
        }

        // Préparer résultats
        return view('pages.admin.dashboard', [
            'balanceCaisse' => $balanceCaisse,
            'totalExpected' => $totalExpected,
            'totalPaid' => $totalPaid,
            'debtorsCount' => $debtorsCount,
            'topDebtors' => $topDebtors,
            'recentPayments' => $recentPayments,
            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }
}
