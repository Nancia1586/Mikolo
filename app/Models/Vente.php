<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{ protected $table = 'vente';

    /**
     * @var array $fillable
     */
protected $id;
protected $date;
protected $idclient;
protected $idpointvente;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'date',
        'idclient',
        'idpointvente'
    ];
    use HasFactory;

    public static function lastid(){
        $tab = Laptop::fromQuery("select * from vente order by id desc limit 1");
        return $tab[0]['id'];
    }

    public static function getvente($id){
        $tab = Laptop::fromQuery("select * from v_vente where id = ".$id);
        return $tab[0];
    }

    public static function totalventeglobal($annee){
        $tab = Laptop::fromQuery("select * from v_venteglobaltoutmoisannee where annee = ".$annee);
        return $tab;
    }

    public static function anneeventeglobal(){
        $tab = Laptop::fromQuery("select * from v_anneeventeglobal");
        return $tab;
    }

    public static function totalventeparpv($idpointvente,$annee){
        $tab = Laptop::fromQuery("select * from v_ventetoutpvtoutmoisannee where idpointvente = ".$idpointvente." and annee = ".$annee);
        return $tab;
    }

    public static function anneeventepv(){
        $tab = Laptop::fromQuery("select * from v_anneeventepv");
        return $tab;
    }

    public static function totalbeneficeglobal($annee){
        $tab = Laptop::fromQuery("select * from v_beneficeglobaltoutmoisannee where annee = ".$annee);
        return $tab;
    }

    public static function stockpv($idlaptop,$idpv){
        $tab = Laptop::fromQuery("select * from v_stockpv where idlaptop = ".$idlaptop." and idpointvente = ".$idpv);
        return $tab;
    }

    public static function anneebenefice(){
        $tab = Laptop::fromQuery("select * from v_anneebenefice");
        return $tab;
    }

    public static function gettotalvente($mois,$annee,$idpointvente){
        $tab = Laptop::fromQuery("select * from v_ventetoutpvtoutmoisannee where numero = ".$mois." and annee = ".$annee." and idpointvente = ".$idpointvente);
        return $tab[0]['total'];
    }
}
