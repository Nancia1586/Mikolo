<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{ protected $table = 'marque';

    /**
     * @var array $fillable
     */
protected $id;
protected $marque;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'marque'
    ];
    use HasFactory;

}
