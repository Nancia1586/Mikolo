<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicule extends Model
{ protected $table = 'typevehicule';

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
