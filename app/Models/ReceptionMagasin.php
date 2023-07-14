<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionMagasin extends Model
{ protected $table = 'receptionmagasin';

    /**
     * @var array $fillable
     */
protected $id;
protected $date;
protected $idlaptop;
protected $quantite;
protected $prixunitaire;
protected $idpointvente;
protected $idrenvoipv;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'date',
        'idlaptop',
        'quantite',
        'prixunitaire',
        'idpointvente',
        'idrenvoipv'
    ];
    use HasFactory;

}
