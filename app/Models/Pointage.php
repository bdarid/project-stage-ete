<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'heure_arrive',
        'heure_depart',
        'statut',
        'Justification_retard',
        'type_justif_absence',
        'reponse_absense',
        'users_id',
        'manager_id',
        'conge_id',
    ];
public function users(){
    return $this->belongsTo(Users::class);
}
public function manager(){
    return $this->belongsTo(Users::class,'manager_id');
}
public function conge(){
    return $this->belongsTo(Conge::class);
}
}
