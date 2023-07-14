<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{ protected $table = 'client';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $contact;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'contact'
    ];
    use HasFactory;

}
