<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paiement extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'users_id',
        'montant',
        'weeks_covered',
        'reste_a_payer',
        'status',
        'commentaire'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'reste_a_payer' => 'decimal:2',
        'weeks_covered' => 'integer',
    ];

    // Relation vers l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relation vers les lignes de semaines couvertes (paiement_semaines)
    public function semaines(): HasMany
    {
        return $this->hasMany(PaiementSemaine::class, 'paiements_id');
    }

    // Relation vers transaction caisse (si tu lies paiement -> caisse)
    public function caisseTransaction()
    {
        return $this->hasOne(Caisse::class, 'paiements_id');
    }

    /**
     * Calcule et met à jour weeks_covered et reste_a_payer selon l'abonnement courant.
     * Cette méthode suppose qu'un abonnement existe pour l'utilisateur.
     */
    public function computeCoverageAndRemaining(): void
    {
        $abonnement = $this->user->abonnement;
        if (! $abonnement) {
            // si pas d'abonnement, on ne calcule pas
            return;
        }

        $montantParSemaine = (float) $abonnement->montant_par_semaine;
        $weeksCovered = (int) floor((float) $this->montant / $montantParSemaine);

        // total payé incluant ce paiement
        $totalPaid = (float) $this->user->paiements()->sum('montant');
        $expected = $abonnement->expectedAmount(); // jusqu'à aujourd'hui
        $remaining = max(0, round($expected - $totalPaid, 2));

        $this->update([
            'weeks_covered' => $weeksCovered,
            'reste_a_payer' => $remaining,
        ]);
    }
}
