<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\DetailVente;
use App\Models\Client;
use App\Models\Commission;
use App\Models\Laptop;
use App\Models\MouvementPV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function liste()
    {
        $date = request('date');
        $nom = request('nom');
        $contact = request('contact');

        $idpv = Session::get('idpointvente');
        $liste = Vente::from("v_vente");
        $liste->whereRaw('idpointvente = ?', [$idpv]);

        if ($date) {
            $liste->whereRaw('date = ?', [$date]);
        }
        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
        }
        if ($contact) {
            $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $vente = $liste->paginate(4);
        $vente->appends(request()->query());
        return view('vente.liste',
        [
            'vente' => $vente
        ]);
    }

    public function addform()
    {
        $client =  Client::all();
        return view('vente.addform',
        [
            'client' => $client
        ]);
    }

    public function add()
    {
        $date = request('date');
        $idclient = request('client');
        $idpv = Session::get('idpointvente');

        $vente = new Vente();
        $vente->date = $date;
        $vente->idclient = $idclient;
        $vente->idpointvente = $idpv;
        $vente->save();

        $idvente = Vente::lastid();
        Session::put('idvente',$idvente);
        Session::put('datedt',$date);
        // echo $idvente;

        $laptop = Laptop::all();
        $detail = DetailVente::from("v_detailvente");
        $detail->whereRaw('idvente = ?', [$idvente]);
        $detail->orderBy('id', 'asc');
        $dt = $detail->paginate(4);
        $dt->appends(request()->query());
        $erreur = '';
        return view('vente.adddetailform',
        [
            'detail' => $dt,
            'laptop' => $laptop,
            'erreur' => $erreur
        ]);
    }

    public function adddetail()
    {
        $idpv = Session::get('idpointvente');
        $idvente = Session::get('idvente');
         $datedt = Session::get('datedt');

        $laptop = Laptop::all();
        $detail = DetailVente::from("v_detailvente");
        $detail->whereRaw('idvente = ?', [$idvente]);
        $detail->orderBy('id', 'asc');
        $dt = $detail->paginate(4);
        $dt->appends(request()->query());

        $stockpv = Vente::stockpv(request('laptop'),$idpv);

        echo request('quantite');
        echo $stockpv[0]['entree'] - $stockpv[0]['sortie'];

        if(request('quantite') > ($stockpv[0]['entree'] - $stockpv[0]['sortie'])){
            $erreur = 'Quantite en stock insuffisant!';
            return view('vente.adddetailform',
            [
                'detail' => $dt,
                'laptop' => $laptop,
                'erreur' => $erreur
            ]);
        }
        else{
            $vente = new DetailVente();
        $vente->idvente=$idvente;
        $vente->idlaptop=request('laptop');
        $vente->quantite=request('quantite');
        $vente->prixunitaire=Laptop::getprix(request('laptop'));
        $vente->save();

        $stockpv = Vente::from("v_stockpv");
        $stockpv = $stockpv->whereRaw('idpointvente = ?',[$idpv]);
        $stockpv = $stockpv->whereRaw('idlaptop = ?',[request('laptop')]);


             $mvt = new MouvementPV();
            $mvt->date=$datedt;
            $mvt->idlaptop=request('laptop');
            $mvt->entree=0;
            $mvt->sortie=request('quantite');
            // $mvt->quantite=request('quantite');
            $mvt->prixunitaire=Laptop::getprix(request('laptop'));
            $mvt->idpointvente=$idpv;
            $mvt->save();

            return view('vente.adddetailform',
            [
                'detail' => $dt,
                'laptop' => $laptop,
                'erreur' => ''
            ]);
        }



    }

    public function listedetail()
    {
        $date = request('date');
        $nom = request('nom');
        $contact = request('contact');
        $idvente = request('idvente');

        $liste = DetailVente::from("v_detailvente");
        $liste->whereRaw('idvente = ?', [$idvente]);

        if ($date) {
            $liste->whereRaw('date = ?', [$date]);
        }
        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
        }
        if ($contact) {
            $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $detail = $liste->paginate(4);
        $detail->appends(request()->query());
        $vente = Vente::getvente($idvente);
        return view('vente.listedetail',
        [
            'detail' => $detail,
            'vente' => $vente
        ]);
    }

    public function listedetaillee()
    {
        $reference = request('reference');
        $prixmin = request('prixmin');
        $prixmax = request('prixmax');

        $idpv = Session::get('idpointvente');
        $liste = DetailVente::from("v_detailvente");
        $liste->whereRaw('idpointvente = ?', [$idpv]);

        if ($reference) {
            $liste->whereRaw('lower(reference) like ?', ["%".strtolower($reference)."%"]);
        }
        if ($prixmin) {
            $liste->whereRaw('prixunitaire * quantite >= ?', [$prixmin]);
        }
        if ($prixmax) {
            $liste->whereRaw('prixunitaire * quantite <= ?', [$prixmax]);
        }

        $liste->orderBy('date', 'asc');
        $detail = $liste->paginate(4);
        $detail->appends(request()->query());
        return view('vente.listedetaillee',
        [
            'detail' => $detail
        ]);
    }

    // //Calcul commission d'un mois d'un point de vente
    // public function montantcommission($idpointvente)
    // {
    //     $mois = request('mois');
    //     $annee = request('annee');
    //     $commission = Commission::commission($mois, $annee);
    //     $total = Vente::gettotalvente($mois,$annee,$idpointvente);
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
}


