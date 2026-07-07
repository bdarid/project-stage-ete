<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departements extends Model
{

    use HasFactory;
    protected $fillable = [
        'nom_departement',
        'nbre_employes',
    ];
    public function users(){
        return $this->belongsToMany(Users::class);
    }
    public function objectifs()
{
    return $this->belongsToMany(
        Objectif::class,
        'obj_departement',
        'departement_id',
        'objectif_id'
    );
}
}
