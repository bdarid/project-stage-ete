<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taches extends Model
{
    use HasFactory;
    protected $fillable = [
    'titre_taches',
    'description_taches',
    'date_debut',
    'duree',
    'date_fin',
    'priorite',
    'statut',
    'justif_retard_tache',
    'type_justif',
];
    public function users(){
        return $this->belongsToMany(Users::class, 'user_taches', 'taches_id', 'users_id');
    }
}
