<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{ protected $table = 'produit';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $prix;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'prix'
    ];
    use HasFactory;

}
