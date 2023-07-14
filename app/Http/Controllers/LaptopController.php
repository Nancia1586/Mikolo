<?php

namespace App\Http\Controllers;

use App\Models\AffichageEcran;
use App\Models\TypeDisqueDur;
use App\Models\CoreProcesseur;
use App\Models\TypeRam;
use App\Models\Laptop;
use App\Models\Marque;
use App\Models\Ecran;
use App\Models\Ram;
use App\Models\DisqueDur;
use App\Models\Fabriquant;
use App\Models\Processeur;
use App\Models\ResolutionEcran;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        $reference = request('reference');
        $marque = request('marque');
        $fabriquant = request('fabriquant');
        $core = request('core');
        $generation = request('generation');
        $nbcoeur = request('nbcoeur');
        $frequence = request('frequence');
        $typeram = request('typeram');
        $capaciteram = request('capaciteram');
        $taille = request('taille');
        $resolution = request('resolution');
        $affichage = request('affichage');
        $typedisque = request('typedisque');
        $capacitedisque = request('capacitedisque');
        $prix = request('prix');

        //Pour recherche simple ---------------
        // $mot = request('mot');
        // ------------------------------------

        $liste = Laptop::from("v_laptop");

        if ($reference) {
            $liste->whereRaw('lower(reference) like ?', ["%".strtolower($reference)."%"]);

        }
        if ($marque) {
            $liste->whereRaw('idmarque = ?', [$marque]);

        }
        if ($fabriquant) {
            $liste->whereRaw('idfabriquant = ?', [$fabriquant]);

        }
        if ($core) {
            $liste->whereRaw('idcoreprocesseur = ?', [$core]);
        }
        if ($generation) {
            $liste->whereRaw('generation = ?', [$generation]);
        }
        if ($nbcoeur) {
            $liste->whereRaw('nbcoeur = ?', [$nbcoeur]);
        }
        if ($frequence) {
            $liste->whereRaw('frequence = ?', [$frequence]);
        }
        if ($typeram) {
            $liste->whereRaw('idtyperam = ?', [$typeram]);
        }
        if ($capaciteram) {
            $liste->whereRaw('capaciteram = ?', [$capaciteram]);
        }
        if ($taille) {
            $liste->whereRaw('taille = ?', [$taille]);
        }
        if ($resolution) {
            $liste->whereRaw('idresolution = ?', [$resolution]);
        }
        if ($affichage) {
            $liste->whereRaw('idaffichage = ?', [$affichage]);
        }
        if ($typedisque) {
            $liste->whereRaw('idtypedisque = ?', [$typedisque]);
        }
        if ($capacitedisque) {
            $liste->whereRaw('capacitedisque = ?', [$capacitedisque]);
        }
        if ($prix) {
            $liste->whereRaw('prix <= ?', [$prix]);
        }

        //Pour recherche simple ---------------
        // if ($mot) {
        //     $liste->orWhereRaw('lower(numero) like ?', ["%".strtolower($mot)."%"]);
        //     $liste->orWhereRaw('lower(marque) like ?', ["%".strtolower($mot)."%"]);
        //     $liste->orWhereRaw('lower(modele) like ?', ["%".strtolower($mot)."%"]);
        //     $liste->orWhereRaw('lower(type) like ?', ["%".strtolower($mot)."%"]);
        // }
        // ------------------------------------

        $liste->orderBy('id', 'asc');
        $laptop = $liste->paginate(5);
        $laptop->appends(request()->query());
        $liste_marque = Marque::all();
        $liste_marque = Marque::all();
        $fabriquant = Fabriquant::all();
        $core = CoreProcesseur::all();
        $typeram = TypeRam::all();
        $resolution = ResolutionEcran::all();
        $affichage = AffichageEcran::all();
        $typedisque = TypeDisqueDur::all();
        return view('laptop.liste',
            [
                'laptop' => $laptop,
                'marque' => $liste_marque,
                'fabriquant' => $fabriquant,
                'core' => $core,
                'typeram' => $typeram,
                'resolution' => $resolution,
                'affichage' => $affichage,
                'typedisque' => $typedisque
            ]);
    }

    public function addform()
    {
        $liste_marque = Marque::all();
        $fabriquant = Fabriquant::all();
        $core = CoreProcesseur::all();
        $typeram = TypeRam::all();
        $resolution = ResolutionEcran::all();
        $affichage = AffichageEcran::all();
        $typedisque = TypeDisqueDur::all();
        return view('laptop.addform',
            [
                'marque' => $liste_marque,
                'fabriquant' => $fabriquant,
                'core' => $core,
                'typeram' => $typeram,
                'resolution' => $resolution,
                'affichage' => $affichage,
                'typedisque' => $typedisque
            ]);
    }

    public function add()
    {
        $processeur = new Processeur();
        $processeur -> idfabriquant = request('fabriquant');
        $processeur -> idcoreprocesseur = request('core');
        $processeur -> nbcoeur = request('nbcoeur');
        $processeur -> generation = request('generation');
        $processeur -> frequence = request('frequence');
        $processeur->save();
        $idprocesseur = Processeur::lastid();

        $ram = new Ram();
        $ram -> idtype = request('typeram');
        $ram -> capacite = request('capaciteram');
        $ram->save();
        $idram = Ram::lastid();

        $ecran = new Ecran();
        $ecran -> taille = request('taille');
        $ecran -> idresolution = request('resolution');
        $ecran -> idaffichage = request('affichage');
        $ecran->save();
        $idecran = Ecran::lastid();

        $disquedur = new DisqueDur();
        $disquedur -> idtype = request('typedisque');
        $disquedur -> capacite = request('capacitedisque');
        $disquedur->save();
        $iddisquedur = DisqueDur::lastid();

        $laptop = new Laptop();
        $laptop->reference=request('reference');
        $laptop->idmarque=request('marque');
        $laptop->idprocesseur=$idprocesseur;
        $laptop->idram=$idram;
        $laptop->idecran=$idecran;
        $laptop->iddisquedur=$iddisquedur;
        $laptop->prix=request('prix');
        $laptop->prixachat=request('prixachat');
        $laptop->save();
        return redirect('/laptop/liste');
    }

    public function update()
    {
        $processeur = new Processeur();
        $processeur -> idfabriquant = request('fabriquant');
        $processeur -> idcoreprocesseur = request('core');
        $processeur -> nbcoeur = request('nbcoeur');
        $processeur -> generation = request('generation');
        $processeur -> frequence = request('frequence');
        $processeur->save();
        $idprocesseur = Processeur::lastid();

        $ram = new Ram();
        $ram -> idtype = request('typeram');
        $ram -> capacite = request('capaciteram');
        $ram->save();
        $idram = Ram::lastid();

        $ecran = new Ecran();
        $ecran -> taille = request('taille');
        $ecran -> idresolution = request('resolution');
        $ecran -> idaffichage = request('affichage');
        $ecran->save();
        $idecran = Ecran::lastid();

        $disquedur = new DisqueDur();
        $disquedur -> idtype = request('typedisque');
        $disquedur -> capacite = request('capacitedisque');
        $disquedur->save();
        $iddisquedur = DisqueDur::lastid();

        $laptop = Laptop::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $laptop->update([
            'reference' => request('reference'),
            'idmarque' => request('marque'),
            'idprocesseur' => $idprocesseur,
            'idram' => $idram,
            'idecran' => $idecran,
            'iddisquedur' => $iddisquedur,
            'prix' => request('prix'),
            'prixachat' => request('prixachat')
        ]);
        return redirect('/laptop/liste');
    }

    public function supprimer()
    {
        $laptop = Laptop::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $laptop->delete();
        return redirect('/laptop/liste');
    }
}
