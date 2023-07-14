<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecran extends Model
{ protected $table = 'ecran';

    /**
     * @var array $fillable
     */
protected $id;
protected $taille;
protected $idresolution;
protected $idaffichage;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'taille',
        'idresolution',
        'idaffichage'
    ];
    use HasFactory;

    public static function lastid(){
        $tab = Laptop::fromQuery("select * from ecran order by id desc limit 1");
        return $tab[0]['id'];
    }
}
