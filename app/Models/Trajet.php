<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{ protected $table = 'trajet';

    /**
     * @var array $fillable
     */
protected $id;
protected $motif;
protected $datedebut;
protected $heuredebut;
protected $lieudebut;
protected $kilometragedebut;
protected $datefin;
protected $heurefin;
protected $lieufin;
protected $kilometragefin;
protected $montantcarburant;
protected $quantitecarburant;
protected $idvehicule;
protected $idchauffeur;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'motif',
        'datedebut',
        'heuredebut',
        'lieudebut',
        'kilometragedebut',
        'datefin',
        'heurefin',
        'lieufin',
        'kilometragefin',
        'montantcarburant',
        'quantitecarburant',
        'idvehicule',
        'idchauffeur'
    ];
    use HasFactory;

    public static function liste(){
        $tab = Vehicule::fromQuery("select * from v_vehiculechauffeurtrajet");
        return $tab;
    }

    public static function get($idvehicule){
        $tab = Vehicule::fromQuery("select * from v_vehiculechauffeurtrajet where idvehicule = ".$idvehicule);
        return $tab;
    }

    // public static function verifylastkilometrage($idvehicule,$){
    //     $tab = Vehicule::fromQuery("select * from v_vehiculechauffeurtrajet");
    //     return $tab;
    // }
}
