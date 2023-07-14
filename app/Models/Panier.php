<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{ protected $table = 'panier';

    /**
     * @var array $fillable
     */
protected $id;
protected $sessionid;
protected $produitid;
protected $quantite;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'sessionid',
        'produitid',
        'quantite'
    ];
    use HasFactory;

}
