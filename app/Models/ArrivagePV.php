<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrivagePV extends Model
{ protected $table = 'arrivagepv';

    /**
     * @var array $fillable
     */
protected $id;
protected $date;
protected $idlaptop;
protected $quantite;
protected $prixunitaire;
protected $idpointvente;
protected $idsortiemagasin;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'date',
        'idlaptop',
        'quantite',
        'prixunitaire',
        'idpointvente',
        'idsortiemagasin'
    ];
    use HasFactory;

}
