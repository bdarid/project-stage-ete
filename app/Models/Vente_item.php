<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'vente_id',
        'categorie_id',
        'achat_id',
        'prix_unitaire',
        'quantite',
    ];
    public function vente(){
        return $this->belongsTo(Vente::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function achat(){
        return $this->belongsTo(Achat::class);
    }
}
