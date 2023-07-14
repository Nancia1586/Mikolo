<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echeance extends Model
{ protected $table = 'echeance';

    /**
     * @var array $fillable
     */
protected $id;
protected $debut;
protected $fin;
protected $idvehicule;
protected $idtypeecheance;
protected $montant;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'debut',
        'fin',
        'idvehicule',
        'idtypeecheance',
        'montant'
    ];
    use HasFactory;

    public static function liste($idvehicule,$idtypeecheance){
        $tab = Vehicule::fromQuery("select * from echeance where idvehicule = ".$idvehicule." and idtypeecheance = ".$idtypeecheance);
        return $tab;
    }

    public static function situation($idtypeecheance){
        $tab = Vehicule::fromQuery("select * from v_situationecheancevehicule where idtypeecheance = ".$idtypeecheance);
        return $tab;
    }
}
