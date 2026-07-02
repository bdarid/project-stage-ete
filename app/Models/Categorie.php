<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_categorie',
        'description_categorie',
        'parent_id',
    ];

    // Relation : Une catégorie a plusieurs sous-catégories
    public function sousCategories()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    // Relation : Une catégorie appartient à une catégorie parente
    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function achat(){
        return $this->hasMany(Achat::class);
    }
    public function vente(){
        return $this->hasMany(Vente::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
    public function ventesItems(){
        return $this->hasMany(Vente_item::class);
    }
    public function produits(){
        return $this->hasMany(Produit::class);
    }
    public function users(){
        return $this->belongsTo(Users::class);
    }
}
