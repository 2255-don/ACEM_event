<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Abonnement extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'users_id',
        'start_date',
        'montant_par_semaine',
    ];

    protected $casts = [
        'start_date' => 'date',
        'montant_par_semaine' => 'decimal:2',
    ];

    // Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Compte le nombre de dimanches (inclusifs) depuis le start_date jusqu'à $dateRef.
     * Si $dateRef est null, utilise aujourd'hui.
     */
    public function weeksDue(?Carbon $dateRef = null): int
    {
        $dateRef = $dateRef ? $dateRef->copy()->startOfDay() : Carbon::now()->startOfDay();
        $start = $this->start_date instanceof Carbon ? $this->start_date->copy()->startOfDay() : Carbon::parse($this->start_date)->startOfDay();

        if ($dateRef->lt($start)) {
            return 0;
        }

        // On compte en sautant semaine par semaine depuis le dimanche de départ.
        $count = 0;
        $current = $start->copy();
        while ($current->lte($dateRef)) {
            if ($current->dayOfWeek === Carbon::SUNDAY) {
                $count++;
            }
            $current->addWeek();
        }
        return $count;
    }

    /**
     * Montant attendu jusqu'à $dateRef (weeksDue * montant_par_semaine)
     */
    public function expectedAmount(?Carbon $dateRef = null): float
    {
        $weeks = $this->weeksDue($dateRef);
        // multiplication décimale stockée en decimal:2; on renvoie float arrondi à 2 décimales
        return round($weeks * (float) $this->montant_par_semaine, 2);
    }

    /**
     * Total payé par l'utilisateur (sommes de paiements enregistrés jusqu'à $dateRef).
     */
    public function totalPaid(?Carbon $dateRef = null): float
    {
        $query = $this->user->paiements();
        if ($dateRef) {
            $query->where('created_at', '<=', $dateRef);
        }
        return (float) $query->sum('montant');
    }

    /**
     * Reste à payer = max(0, expected - totalPaid)
     */
    public function remainingAmount(?Carbon $dateRef = null): float
    {
        $expected = $this->expectedAmount($dateRef);
        $paid = $this->totalPaid($dateRef);
        $remaining = max(0, round($expected - $paid, 2));
        return $remaining;
    }

    /**
     * True si l'utilisateur est à jour (reste == 0)
     */
    public function isUpToDate(?Carbon $dateRef = null): bool
    {
        return $this->remainingAmount($dateRef) <= 0;
    }
}
