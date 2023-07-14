<?php

namespace App\Http\Controllers;

use App\Models\ArrivageMagasin;
use App\Models\MouvementMagasin;
use App\Models\Perte;
use App\Models\ArrivagePV;
use App\Models\RenvoiPV;
use App\Models\MouvementPV;
use App\Models\Utilisateur;
use App\Models\UtilisateurPV;
use App\Models\PointVente;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use FPDF;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class PointVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //Colonne anaovana recherche rehetra (pour recherche multicritere)
        $emplacement = request('emplacement');
        $contact = request('contact');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = PointVente::from("pointvente");

        if ($emplacement) {
            $liste->whereRaw('lower(emplacement) like ?', ["%".strtolower($emplacement)."%"]);
        }
        if ($contact) {
            $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(emplacement) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(contact) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->orderBy('id', 'asc');
        $pointvente = $liste->paginate(4);
        $pointvente->appends(request()->query());
        return view('pointvente.liste',
            [
                'pointvente' => $pointvente
            ]);
    }

    public function add()
    {
        $pointvente = new PointVente();
        $pointvente->emplacement=request('emplacement');
        $pointvente->contact=request('contact');
        $pointvente->save();
        return redirect('/pointvente/liste');
    }

    public function update()
    {
        $pointvente = PointVente::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $pointvente->update([
            'emplacement' => request('emplacement'),
            'contact' => request('contact')
        ]);
        return redirect('/pointvente/liste');
    }

    public function supprimer()
    {
        $pointvente = PointVente::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $pointvente->delete();
        return redirect('/pointvente/liste');
    }

    public function pv_affectation()
    {
        $emplacement = request('emplacement');
        $contact = request('contact');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = PointVente::from("pointvente");

        if ($emplacement) {
            $liste->whereRaw('lower(emplacement) like ?', ["%".strtolower($emplacement)."%"]);
        }
        if ($contact) {
            $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(emplacement) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(contact) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->orderBy('id', 'asc');
        $pointvente = $liste->paginate(4);
        $pointvente->appends(request()->query());
        return view('pointvente.pv_affectation',
            [
                'pointvente' => $pointvente
            ]);
    }

    public function user_affectation()
    {
        $idpv = request('idpv');
        Session::put('idpv',$idpv);
        $nom = request('nom');
        $email = request('email');

        $liste = Utilisateur::from("v_utilisateurlibre");

        if ($email) {
            $liste->whereRaw('lower(email) like ?', ["%".strtolower($email)."%"]);
        }
        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $utilisateur = $liste->paginate(4);
        $utilisateur->appends(request()->query());
        return view('pointvente.user_affectation',
            [
                'utilisateur' => $utilisateur,
                'idpv' => $idpv
            ]);
    }

    public function affectation()
    {
        $idpv = request('idpv');
        $alluser = Utilisateur::all();
        for($i=0; $i<count($alluser); $i++){
            $user = request('user'.$alluser[$i]['id']);
            if($user){
                $userpv = new UtilisateurPV();
                $userpv->idpointvente = $idpv;
                $userpv->idutilisateur = $user;
                $userpv->save();
            }
        }
        return redirect('/pointvente/pv_affectation');
    }

    public function reception()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');

        $idpv = Session::get('idpointvente');
        $liste = ArrivageMagasin::from("v_receptionpv");
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

        $liste->orderBy('id', 'asc');
        $reception = $liste->paginate(4);
        $reception->appends(request()->query());
        $laptop = Laptop::all();
        $pointvente = PointVente::all();
        $emplacement = PointVente::getbyid($idpv);
        return view('pointvente.reception',
        [
            'reception' => $reception,
            'laptop' => $laptop,
            'pointvente' => $pointvente,
            'emplacement' => $emplacement
        ]);
    }

    public function add_reception()
    {
        $arrivage = new ArrivagePV();
        $arrivage->date=request('date');
        $arrivage->idlaptop=request('idlaptop');
        $arrivage->quantite=request('quantite');
        $arrivage->prixunitaire=request('prixunitaire');
        $arrivage->idpointvente=request('idpointvente');
        $arrivage->idsortiemagasin=request('idsortiemagasin');
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

        $mouvement = new MouvementPV();
        $mouvement->date=request('date');
        $mouvement->idlaptop=request('idlaptop');
        $mouvement->entree=request('quantite');
        $mouvement->sortie=0;
        $mouvement->prixunitaire=request('prixunitaire');
        $mouvement->idpointvente=request('idpointvente');
        $mouvement->save();

        return redirect('/pointvente/reception');
    }

    public function liste_reception()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');

        $idpv = Session::get('idpointvente');
        $liste = ArrivageMagasin::from("v_listereceptionpv");
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

        $liste->orderBy('id', 'asc');
        $reception = $liste->paginate(4);
        $reception->appends(request()->query());
        $laptop = Laptop::all();
        $pointvente = PointVente::all();
        $emplacement = PointVente::getbyid($idpv);
        return view('pointvente.liste_reception',
        [
            'reception' => $reception,
            'laptop' => $laptop,
            'pointvente' => $pointvente,
            'emplacement' => $emplacement
        ]);
    }

    public function renvoie()
    {
        $date = request('date');
        $reference = request('reference');
        $quantite = request('quantite');
        $prixunitaire = request('prixunitaire');

        $idpv = Session::get('idpointvente');
        $liste = RenvoiPV::from("v_renvoipv");
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

        $liste->orderBy('id', 'asc');
        $renvoi = $liste->paginate(4);
        $renvoi->appends(request()->query());
        $laptop = Laptop::all();
        $erreur = '';
        if(request('erreur')){
            $erreur = 'Quantite en stock insuffisant!';
        }
        return view('pointvente.renvoi',
        [
            'renvoi' => $renvoi,
            'laptop' => $laptop,
            'erreur' => $erreur
        ]);
    }

    public function add_renvoi()
    {
        $sortie = new RenvoiPV();
        $sortie->date=request('date');
        $sortie->idlaptop=request('laptop');
        $sortie->quantite=request('quantite');
        $sortie->prixunitaire=Laptop::getprix(request('laptop'));
        $idpv = Session::get('idpointvente');
        $sortie->idpointvente=$idpv;
        $stock = MouvementPV::situationstock(request('laptop'));
        if($stock['entree'] < request('quantite')){
            return redirect('/pointvente/renvoie?erreur=1');
        }
        $sortie->save();

        $mouvement = new MouvementPV();
        $mouvement->date=request('date');
        $mouvement->idlaptop=request('laptop');
        $mouvement->entree=0;
        $mouvement->sortie=request('quantite');
        $mouvement->prixunitaire=Laptop::getprix(request('laptop'));
        $mouvement->idpointvente=$idpv;
        $mouvement->save();

        // $mouvement2 = new MouvementMagasin();
        // $mouvement2->date=request('date');
        // $mouvement2->idlaptop=request('laptop');
        // $mouvement2->entree=request('quantite');
        // $mouvement2->sortie=0;
        // $mouvement2->prixunitaire=Laptop::getprix(request('laptop'));
        // $mouvement2->save();

        return redirect('/pointvente/renvoie');
    }

}
