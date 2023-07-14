<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{ protected $table = 'laptop';

    /**
     * @var array $fillable
     */
protected $id;
protected $reference;
protected $idmarque;
protected $idprocesseur;
protected $idram;
protected $idecran;
protected $iddisquedur;
protected $prix;
protected $prixachat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'reference',
        'idmarque',
        'idprocesseur',
        'idram',
        'idecran',
        'iddisquedur',
        'prix',
        'prixachat'
    ];
    use HasFactory;

    //Liste avec recherche multicritere
    public static function liste(){
        $tab = Laptop::fromQuery("select * from v_laptop");
        return $tab;
    }

    //Get prix de vente
    public static function getprix($id){
        $tab = Laptop::fromQuery("select * from v_laptop where id = ".$id);
        return $tab[0]['prix'];
    }

    //Get prix d'achat
    public static function getprixachat($id){
        $tab = Laptop::fromQuery("select * from v_laptop where id = ".$id);
        return $tab[0]['prixachat'];
    }
}
