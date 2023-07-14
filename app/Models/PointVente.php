<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{ protected $table = 'pointvente';

    /**
     * @var array $fillable
     */
protected $id;
protected $emplacement;
protected $contact;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'emplacement',
        'contact'
    ];
    use HasFactory;

    public static function getbyid($idpointvente){
        $tab = Laptop::fromQuery("select * from pointvente where id = ".$idpointvente);
        return $tab[0];
    }

    public static function firstid(){
        $tab = Laptop::fromQuery("select * from pointvente order by id asc");
        return $tab[0]['id'];
    }
}
