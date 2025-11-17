<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PaiementSemaine extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'paiement_semaines';

    protected $fillable = [
        'paiements_id',
        'users_id',
        'sunday_date',
        'montant_applique'
    ];

    protected $casts = [
        'sunday_date' => 'date',
        'montant_applique' => 'decimal:2',
    ];

    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class, 'paiements_id');
    }

    /**
     * Retourne la date du dimanche sous forme Carbon.
     */
    public function sundayAsCarbon(): ?Carbon
    {
        return $this->sunday_date ? Carbon::parse($this->sunday_date) : null;
    }
}
