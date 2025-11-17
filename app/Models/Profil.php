<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; 
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasUuids;
    //
    protected $fillable = [
        'libelle',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'profils_id');
    }
}
