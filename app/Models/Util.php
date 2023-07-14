<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    public static function diff_datetime($debut, $fin){
        $datetime1 = \Carbon\Carbon::parse($fin);
        $datetime2 = \Carbon\Carbon::parse($debut);
        $diff = $datetime1->diff($datetime2);   //datetime2 - datetime1
        $array = [];
        $array[0] = $diff->format('%d');    //jours
        $array[1] = $diff->format('%h');    //heures
        $array[2] = $diff->format('%i');    //minutes
        $array[3] = $diff->format('%s');    //secondes
        // dump($array);
        return $array;
    }

    public static function diff_date($debut, $fin){
        $date1 = \Carbon\Carbon::parse($fin);
        $date2 = \Carbon\Carbon::parse($debut);
        $diff = $date1->diffInDays($date2);   //date2 - date1
        echo $diff;
    }

    public static function diff_time($debut, $fin){
        $time1 = \Carbon\Carbon::parse($fin);
        $time2 = \Carbon\Carbon::parse($debut);
        $diff = $time1->diff($time2);   //time2 - time1
        $array = [];
        $array[0] = $diff->format('%h');    //heures
        $array[1] = $diff->format('%i');    //minutes
        $array[2] = $diff->format('%s');    //secondes
        // dump($array);
        return $array;
    }

    public function addToDate($datetime, $jour=0, $heure=0, $minute=0, $seconde=0){
        $date = \Carbon\Carbon::parse($datetime);
        $time = \Carbon\CarbonInterval::create(0, 0, 0, $jour, $heure, $minute, $seconde); // Créer un intervalle de temps de 1 heure et 30 minutes
        $date->add($time); // Ajouter le temps à la date actuelle
        // echo $date; // Afficher la nouvelle date
        return $date;
    }

    public static function format($num){
        return number_format($num, 2, '.', ' ');
    }

    public static function now(){
        return date('Y-m-j', strtotime('today'));;
    }

    //Recherche simple
    public static function recherche_simple($mot){
        $tab = Util::fromQuery("select * from auteur where upper(nom) like upper('%".$mot."%') or upper(email) like upper('%".$mot."%')");
        return $tab;
    }

    //Recherche multicritere
    public static function recherche_multicritere($req){
        $tab = Util::fromQuery($req);
        return $tab;
    }

    //Liste panier
    //Vue a creer:
    //CREATE or REPLACE view v_panier as select p.*,pt.nom,pt.prix,(p.quantite * pt.prix) as prixtotal from panier p join produit pt on p.produitid = pt.id;
    public static function liste_panier($sessionid){
        $tab = Util::fromQuery("select * from v_panier where sessionid = '".$sessionid."' order by id asc");
        return $tab;
    }

    //Verifier sao dia 0 ny quantite anaty panier
    public static function ifZero($id){
        $tab = Util::fromQuery("select * from panier where id = ".$id);
        if($tab[0]['quantite'] == 0){
            return true;
        }
        return false;
    }
}
