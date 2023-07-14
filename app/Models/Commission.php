<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{ protected $table = 'commission';

    /**
     * @var array $fillable
     */
protected $id;
protected $mois;
protected $annee;
protected $totalmin;
protected $totalmax;
protected $commission;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'mois',
        'annee',
        'totalmin',
        'totalmax',
        'commission'
    ];
    use HasFactory;

    // public static function getcommission($mois,$annee){
    //     $tab=Commission::fromQuery("select * from commission where mois = (select mois from commission where mois <= ".$mois." and annee <= ".$annee." order by annee,mois desc limit 1) and annee = (select annee from commission where mois <= ".$mois." and annee <= ".$annee." order by annee,mois desc limit 1) order by annee,mois desc");
    //     return $tab;
    // }

    // public static function getcommission($mois,$annee){
    //     $tab=Commission::fromQuery("select date('".$annee."-".$mois."-1'),* from commission");
    //     return $tab;
    // }

    public static function first_commission($mois, $annee)
    {

        $com = Commission::fromQuery("select * from commission where mois<=" . $mois . " and annee=" . $annee . " order by mois desc");
        if (count($com) == 0) {
            $com = Commission   ::fromQuery("select * from commission where annee<" . $annee . " order by  annee,mois desc ");
        }
        return $com[0];
    }

    public static function commission($mois, $annee)
    {
        $m = Commission::first_commission($mois, $annee)['mois'];
        $a = Commission::first_commission($mois, $annee)['annee'];
        $com = Commission::fromQuery("select * from commission where mois=" . $m . " and annee=" . $a);
        return $com;
    }


    // public static function total_commission($mois, $annee)
    // {
    //     $m = Commission::first_commission($mois, $annee)['mois'];
    //     $a = Commission::first_commission($mois, $annee)['annee'];
    //     $com = Commission::fromQuery("select * from commission where mois=" . $m . " and annee=" . $a);
    //     $s = 0;
    //     for($i=0; $i<count($com); $i++){
    //         $s = $s +
    //     }
    // }


    //Calcul commission d'un mois d'un point de vente
    // public static function montantcommission($mois,$annee,$idpointvente)
    // {
    //     $commission = Commission::commission($mois, $annee); //Le commission
    //     $total = Vente::gettotalvente($mois,$annee,$idpointvente); //le montant
    //     $m = $total;
    //     $res = 0;
    //     for($i=0; $i<count($commission); $i++){
    //         if($m - $commission[$i]['totalmax'] > 0){
    //             $res = $res + (($commission[$i]['totalmax'] * $commission[$i]['commission']) / 100);
    //             $m = $m - $commission[$i]['totalmax'];
    //             continue;
    //         }
    //         else{
    //             $res = $res + (($m * $commission[$i]['commission']) / 100);
    //             break;
    //         }
    //     }
    //     return $res;
    // }

    public static function montantcommission($mois,$annee,$idpointvente)
    {
        $commission = Commission::commission($mois, $annee); //Le commission
        $total = Vente::gettotalvente($mois,$annee,$idpointvente); //le montant
        $m = $total;
        $fait = 0;
        $res = 0;
        for($i=0; $i<count($commission); $i++){
            if($m - ($commission[$i]['totalmax'] - $fait) > 0){
                $res = $res + ((($commission[$i]['totalmax'] - $fait) * $commission[$i]['commission']) / 100);
                $m = $m - ($commission[$i]['totalmax'] - $fait);
                $fait = $commission[$i]['totalmax'];
                continue;
            }
            else{
                $res = $res + (($m * $commission[$i]['commission']) / 100);
                break;
            }
        }
        return $res;
    }

    // public static function totalcommission($mois,$annee,$montant)
    // {
    //     $commission = Commission::commission($mois, $annee);
    //     $total = $montant;
    //     $m = $total;
    //     $res = 0;
    //     for($i=0; $i<count($commission); $i++){
    //         if($m - $commission[$i]['totalmax'] > 0){
    //             $res = $res + (($commission[$i]['totalmax'] * $commission[$i]['commission']) / 100);
    //             $m = $m - $commission[$i]['totalmax'];
    //             continue;
    //         }
    //         else{
    //             $res = $res + (($m * $commission[$i]['commission']) / 100);
    //             break;
    //         }
    //     }
    //     return $res;
    // }

    public static function totalcommission($mois,$annee,$montant)
    {
        $commission = Commission::commission($mois, $annee); //Le commission
        $total = $montant;
        // $total = 55000000;
        $m = $total;
        $fait = 0;
        $res = 0;
        for($i=0; $i<count($commission); $i++){
            if($m - ($commission[$i]['totalmax'] - $fait) > 0){
                $res = $res + ((($commission[$i]['totalmax'] - $fait) * $commission[$i]['commission']) / 100);
                $m = $m - ($commission[$i]['totalmax'] - $fait);
                $fait = $commission[$i]['totalmax'];
                continue;
            }
            else{
                $res = $res + (($m * $commission[$i]['commission']) / 100);
                break;
            }
        }
        return $res;
    }
}

