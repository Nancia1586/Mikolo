<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabriquant extends Model
{ protected $table = 'fabriquant';

    /**
     * @var array $fillable
     */
protected $id;
protected $fabriquant;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'fabriquant'
    ];
    use HasFactory;

}
