<?php

namespace App\Models;

use App\Models\Departements;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Users extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    protected $table = 'users';
    protected $casts = [
        'jours_de_repos' => 'array',
        'date_embauche' => 'datetime',
        'date_naissance' => 'date',
        'email_verified_at' => 'datetime',
    ];
    protected $fillable = [
    'name_users',
    'email',
    'password',
    'CIN',
    'date_embauche',
    'contract_document',
    'date_naissance',
    'jours_de_repos',
        'taux_horaire',
    ];
    public function departements(){
        return $this->belongsToMany(Departements::class);
    }
    public function pointages(){
        return $this->hasMany(Pointage::class);
    }
    public function pointages_manager(){
        return $this->hasMany(Pointage::class,'manager_id');
    }
    Public function conge(){
        return $this->hasMany(Conge::class);
    }
    public function taches(){
        return $this->belongsToMany(Taches::class);
    }
    public function objectifs(){
        return $this->belongsToMany(Objectif::class);
    }
    public function stocks() {
    return $this->hasMany(Stock::class, 'user_id');
}

public function ventes() {
    return $this->hasMany(Vente::class, 'user_id');
}

public function achats() {
    return $this->hasMany(Achat::class, 'user_id');
}

public function produits() {
    return $this->hasMany(Produit::class, 'user_id');
}
    public function getNameAttribute()
    {
        return $this->name_users;
    }

}
