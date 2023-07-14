<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVente extends Model
{ protected $table = 'detailvente';

    /**
     * @var array $fillable
     */
protected $id;
protected $idvente;
protected $idlaptop;
protected $quantite;
protected $prixunitaire;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'idvente',
        'idlaptop',
        'quantite',
        'prixunitaire'
    ];
    use HasFactory;

}
