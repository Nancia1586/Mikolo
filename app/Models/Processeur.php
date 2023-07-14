<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processeur extends Model
{ protected $table = 'processeur';

    /**
     * @var array $fillable
     */
protected $id;
protected $nbcoeur;
protected $generation;
protected $frequence;
protected $idcoreprocesseur;
protected $idfabriquant;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nbcoeur',
        'generation',
        'frequence',
        'idcoreprocesseur',
        'idfabriquant'
    ];
    use HasFactory;

    //Liste avec recherche multicritere
    public static function liste(){
        $tab = Laptop::fromQuery("select * from v_processeur");
        return $tab;
    }

    public static function lastid(){
        $tab = Laptop::fromQuery("select * from processeur order by id desc limit 1");
        return $tab[0]['id'];
    }

}
