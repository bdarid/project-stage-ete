<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorie_id',
        'mouvement_stock',
        'vente_id',
        'achat_id',
        'users_id',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function achat()
    {
        return $this->belongsTo(Achat::class);
    }
    public function users(){
        return $this->belongsTo(Users::class);
    }
}
