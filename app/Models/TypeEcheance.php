<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEcheance extends Model
{ protected $table = 'typeecheance';

    /**
     * @var array $fillable
     */
protected $id;
protected $type;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'type'
    ];
    use HasFactory;

}
