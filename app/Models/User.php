<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'profils_id',
        'entreprise_id',
        'password_changed'
    ];

    protected $hidden = [
        'password',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profils_id');
    }

    // Relation: 1 utilisateur -> 1 abonnement
    public function abonnement(): HasOne
    {
        return $this->hasOne(Abonnement::class, 'users_id');
    }

    // Relation: 1 utilisateur -> plusieurs paiements
    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class, 'users_id');
    }

    // Relation: transactions de caisse liées à cet utilisateur (via paiements)
    public function caisseTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Caisse::class,
            Paiement::class,
            'users_id',        // Foreign key on Paiement table...
            'paiements_id',    // Foreign key on CaisseTransaction table...
            'id',             // Local key on User table...
            'id'              // Local key on Paiement table...
        );
    }
}
