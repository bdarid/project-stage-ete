<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorie_id',
        'prix_vente',
        'prix_achat',
        'nom_fournisseur',
        'date_achat',
        'quantite',
        'users_id',
        'commentaire',
        'produits_id'
    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
        
    }
    public function produit()
{
    return $this->belongsTo(Produit::class, 'produits_id');
}
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function vente_items(){
        return $this->hasMany(Vente_item::class);
    }
    public function users(){
        return $this->belongsTo(Users::class);
    }
}
