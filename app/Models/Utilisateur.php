<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{ protected $table = 'utilisateur';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $email;
protected $mdp;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'email',
        'mdp'
    ];
    use HasFactory;

    public static function login($email,$mdp){
        $tab=Utilisateur::fromQuery("select * from Utilisateur where Email='".$email."' and mdp=md5('".$mdp."') limit 1");
        $id=0;
        if(count($tab)==0){
            return -1;
        }
        return $tab[0]['id'];

    }

    public static function getpointvente($idutilisateur){
        $tab=Utilisateur::fromQuery("select * from v_utilisateurpv where id = ".$idutilisateur);
        $idpv = 0;
        if($tab[0]['idpointvente'] == null){
            return -1;
        }
        return $tab[0]['idpointvente'];
    }
}
