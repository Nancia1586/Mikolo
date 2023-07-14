<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementPV extends Model
{ protected $table = 'mouvementpv';

    /**
     * @var array $fillable
     */
protected $id;
protected $date;
protected $idlaptop;
protected $entree;
protected $sortie;
protected $prixunitaire;
protected $idpointvente;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'date',
        'idlaptop',
        'entree',
        'sortie',
        'prixunitaire',
        'idpointvente'
    ];
    use HasFactory;

    // public static function firstidlaptop(){
    //     $tab = Laptop::fromQuery("select * from mouvementmagasin order by id asc limit 1");
    //     return $tab[0]['idlaptop'];
    // }

    public static function situationstock($idlaptop){
        $tab = Laptop::fromQuery("select * from v_situationstockpv where id = ".$idlaptop);
        return $tab[0];
    }
}
