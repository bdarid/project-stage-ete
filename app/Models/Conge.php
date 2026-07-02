<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_debut',
        'date_fin',
        'solde',
        'users_id',
        'statut',
        'reponse',
        'type_conge',
    ];
    public function pointages(){
        return $this->hasMany(Pointage::class);
    }
    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id');
    
    }
}
