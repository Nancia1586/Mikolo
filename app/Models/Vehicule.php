<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{ protected $table = 'vehicule';

    /**
     * @var array $fillable
     */
protected $id;
protected $numero;
protected $idmarque;
protected $modele;
protected $idtype;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'numero',
        'idmarque',
        'modele',
        'idtype'
    ];
    use HasFactory;

    //Liste avec recherche multicritere
    public static function liste($req){
        $tab = Vehicule::fromQuery($req);
        return $tab;
    }

    public static function disponible($date){
        $req = "";
        if($date == ''){
            $req = "select * from v_typemarquevehicule where id not in (select idvehicule from reservation where date = current_date)";
        }
        else{
            $req = "select * from v_typemarquevehicule where id not in (select idvehicule from reservation where date = '".$date."')";
        }
        $tab = Vehicule::fromQuery($req);
        return $tab;
    }

    public static function get($id){
        $tab = Vehicule::fromQuery("select * from v_typemarquevehicule where id = ".$id);
        return $tab;
    }

}
