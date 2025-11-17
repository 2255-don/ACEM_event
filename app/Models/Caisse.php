<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caisse extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'paiements_id',
        'montant',
        'types', // 'in' ou 'out'
        'description',
        'balance_after',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class, 'paiements_id');
    }
}
