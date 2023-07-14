<?php

namespace App\Http\Controllers;

use App\Models\ArrivageMagasin;
use App\Models\SortieMagasin;
use App\Models\MouvementMagasin;
use App\Models\ReceptionMagasin;
use App\Models\Perte;
use App\Models\Laptop;
use App\Models\PointVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MagasinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function arrivage()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');

        $liste = ArrivageMagasin::from("v_arrivagemagasin");

        if ($date) {
            $liste->whereRaw('date = ?', [$date]);

        }
        if ($reference) {
            $liste->whereRaw('lower(reference) like ?', ["%".strtolower($reference)."%"]);

        }
        if ($quantite) {
            $liste->whereRaw('quantite = ?', [$quantite]);

        }
        if ($prixunitaire) {
            $liste->whereRaw('prixunitaire = ?', [$prixunitaire]);
        }


        $liste->orderBy('id', 'asc');
        $arrivage = $liste->paginate(4);
        $arrivage->appends(request()->query());
        $laptop = Laptop::all();
        return view('magasin.arrivage',
            [
                'arrivage' => $arrivage,
                'laptop' => $laptop
            ]);
    }

    public function add_arrivage()
    {
        $arrivage = new ArrivageMagasin();
        $arrivage->date=request('date');
        $arrivage->idlaptop=request('laptop');
        $arrivage->quantite=request('quantite');
        $arrivage->prixunitaire=Laptop::getprixachat(request('laptop'));
        $arrivage->save();

        $mouvement = new MouvementMagasin();
        $mouvement->date=request('date');
        $mouvement->idlaptop=request('laptop');
        $mouvement->entree=request('quantite');
        $mouvement->sortie=0;
        $mouvement->prixunitaire=Laptop::getprixachat(request('laptop'));
        $mouvement->save();

        return redirect('/magasin/arrivage');
    }

    public function mouvement()
    {
        $laptop = request('laptop');
        $firstidlaptop = MouvementMagasin::firstidlaptop();
        $liste = MouvementMagasin::from("v_mouvementmagasin");

        if ($laptop) {
            $liste->whereRaw('idlaptop = ?', [$laptop]);
        }
        else{
            $liste->whereRaw('idlaptop = ?', [$firstidlaptop]);
        }

        $liste->orderBy('id', 'asc');
        $mouvement = $liste->paginate(4);
        $mouvement->appends(request()->query());
        $laptop = Laptop::all();
        return view('magasin.mouvement',
            [
                'mouvement' => $mouvement,
                'laptop' => $laptop
            ]);
    }

    public function transfert()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');
        $pointvente = request('pointvente');

        $liste = ArrivageMagasin::from("v_sortiemagasin");

        if ($date) {
            $liste->whereRaw('date = ?', [$date]);
        }
        if ($reference) {
            $liste->whereRaw('lower(reference) like ?', ["%".strtolower($reference)."%"]);
        }
        if ($quantite) {
            $liste->whereRaw('quantite = ?', [$quantite]);
        }
        if ($prixunitaire) {
            $liste->whereRaw('prixunitaire = ?', [$prixunitaire]);
        }
        if ($pointvente) {
            $liste->whereRaw('lower(emplacement) like ?', ["%".strtolower($pointvente)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $transfert = $liste->paginate(4);
        $transfert->appends(request()->query());
        $laptop = Laptop::all();
        $pointvente = PointVente::all();
        $erreur = '';
        if(request('erreur')){
            $erreur = 'Quantite en stock insuffisant!';
        }
        return view('magasin.transfert',
        [
            'transfert' => $transfert,
            'laptop' => $laptop,
            'pointvente' => $pointvente,
            'erreur' => $erreur
        ]);
    }

    public function add_transfert()
    {
        $sortie = new SortieMagasin();
        $sortie->date=request('date');
        $sortie->idlaptop=request('laptop');
        $sortie->quantite=request('quantite');
        $sortie->prixunitaire=Laptop::getprix(request('laptop'));
        $sortie->idpointvente=request('pointvente');
        $stock = MouvementMagasin::situationstock(request('laptop'));
        if($stock['entree'] < request('quantite')){
            return redirect('/magasin/transfert?erreur=1');
        }
        $sortie->save();

        $mouvement = new MouvementMagasin();
        $mouvement->date=request('date');
        $mouvement->idlaptop=request('laptop');
        $mouvement->entree=0;
        $mouvement->sortie=request('quantite');
        $mouvement->prixunitaire=Laptop::getprix(request('laptop'));
        $mouvement->save();

        return redirect('/magasin/transfert');
    }

    // public function transfert()
    // {
    //     $pointvente = PointVente::all();
    //     return view('magasin.pv_transfert',
    //     [
    //         'pointvente' => $pointvente
    //     ]);
    // }

    public function laptop_transfert()
    {
        $laptop = Laptop::all();
        return view('magasin.laptop_transfert',
        [
            'laptop' => $laptop
        ]);
    }

    public function reception()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');
        $emplacement = request('emplacement');

        $idpv = Session::get('idpointvente');
        $liste = ArrivageMagasin::from("v_receptionmagasin");
        $liste->whereRaw('reste = quantite');
        $liste->whereRaw('idpointvente = ?', [$idpv]);

        if ($date) {
            $liste->whereRaw('date = ?', [$date]);
        }
        if ($reference) {
            $liste->whereRaw('lower(reference) like ?', ["%".strtolower($reference)."%"]);
        }
        if ($quantite) {
            $liste->whereRaw('quantite = ?', [$quantite]);
        }
        if ($prixunitaire) {
            $liste->whereRaw('prixunitaire = ?', [$prixunitaire]);
        }
        if ($emplacement) {
            $liste->whereRaw('lower(emplacement) like ?', ["%".strtolower($emplacement)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $reception = $liste->paginate(4);
        $reception->appends(request()->query());
        $laptop = Laptop::all();
        $pointvente = PointVente::all();
        $emplacement = PointVente::getbyid($idpv);
        return view('magasin.reception',
        [
            'reception' => $reception,
            'laptop' => $laptop,
            'pointvente' => $pointvente,
            'emplacement' => $emplacement
        ]);
    }

    public function add_reception()
    {
        $arrivage = new ReceptionMagasin();
        $arrivage->date=request('date');
        $arrivage->idlaptop=request('idlaptop');
        $arrivage->quantite=request('quantite');
        $arrivage->prixunitaire=request('prixunitaire');
        $arrivage->idpointvente=request('idpointvente');
        $arrivage->idrenvoipv=request('idrenvoipv');
        $arrivage->save();

        $envoye = request('envoye');
        if(request('quantite') < $envoye){
            $perte = new Perte();
            $perte->date=request('date');
            $perte->idlaptop=request('idlaptop');
            $perte->quantite=$envoye - request('quantite');
            // $perte->prixunitaire=request('prixunitaire');
            $perte->prixunitaire=Laptop::getprixachat(request('idlaptop'));
            $perte->save();
        }

        $mouvement = new MouvementMagasin();
        $mouvement->date=request('date');
        $mouvement->idlaptop=request('idlaptop');
        $mouvement->entree=request('quantite');
        $mouvement->sortie=0;
        $mouvement->prixunitaire=request('prixunitaire');
        $mouvement->save();

        return redirect('/magasin/reception');
    }
}
