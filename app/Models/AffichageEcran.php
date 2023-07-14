<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffichageEcran extends Model
{ protected $table = 'affichageecran';

    /**
     * @var array $fillable
     */
protected $id;
protected $affichage;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'affichage'
    ];
    use HasFactory;

}
