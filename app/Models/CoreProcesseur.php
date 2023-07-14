<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreProcesseur extends Model
{ protected $table = 'coreprocesseur';

    /**
     * @var array $fillable
     */
protected $id;
protected $core;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'core'
    ];
    use HasFactory;

}
