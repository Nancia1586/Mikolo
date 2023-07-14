<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{ protected $table = 'mois';

    /**
     * @var array $fillable
     */
protected $id;
protected $numero;
protected $nom;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'numero',
        'nom'
    ];
    use HasFactory;

}
