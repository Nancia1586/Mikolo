<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResolutionEcran extends Model
{ protected $table = 'resolutionecran';

    /**
     * @var array $fillable
     */
protected $id;
protected $resolution;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'resolution'
    ];
    use HasFactory;

}
