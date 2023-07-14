<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrivageMagasin extends Model
{ protected $table = 'arrivagemagasin';

    /**
     * @var array $fillable
     */
protected $id;
protected $date;
protected $idlaptop;
protected $quantite;
protected $prixunitaire;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'date',
        'idlaptop',
        'quantite',
        'prixunitaire'
    ];
    use HasFactory;

}
