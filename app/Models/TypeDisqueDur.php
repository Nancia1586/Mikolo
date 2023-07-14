<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDisqueDur extends Model
{ protected $table = 'typedisquedur';

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
