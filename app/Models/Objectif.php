<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre_objectif',
        'description_objectif',
        'file_json',
        'date_debut_obj',
        'date_fin_obj',
        'etat_avancement_objectif',
    ];

    //  JSON en array PHP
    protected $casts = [
        'file_json' => 'array',
    ];
    public function departement(){
        return $this->belongsToMany(Departements::class);
    }
    public function users(){
        return $this->belongsToMany(Users::class);
    }
}
