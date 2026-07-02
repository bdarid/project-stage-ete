<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_produit',
        'description_produit',
        'quantite_produit',
        'date_expiration',
        'stock_actuel',
        'prix_vente_moy',
        'prix_achat_moy',
        'alerte_stock',
        'categorie_id',
        'reference',
        'users_id',
    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function users(){
        return $this->belongsTo(Users::class);
    }
}
