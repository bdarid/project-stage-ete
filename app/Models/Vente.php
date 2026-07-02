<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    protected $fillable = [
        'info_clients',
        'date_vente',
        'mode_payment',
        'numero_vente',
        'categorie_id',
        'users_id',
    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function venteitems(){
        return $this->hasMany(Vente_item::class);
    }
    public function users(){
        return $this->belongsTo(Users::class);
    }
}
