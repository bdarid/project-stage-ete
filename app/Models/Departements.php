<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departements extends Model
{

    use HasFactory;
    protected $fillable = [
        'nom_departement',
    ];
    public function users()
{
    return $this->belongsToMany(
        Users::class,
        'user_depart',
        'departements_id',
        'users_id'
    );
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
