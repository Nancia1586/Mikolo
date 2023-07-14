<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrajetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        $trajet = Trajet::liste();
        return view('trajet.liste',
            [
                'trajet' => $trajet
            ]);
    }

    public function addform()
    {
        $vehicule = Vehicule::all();
        return view('trajet.add',
            [
                'vehicule' => $vehicule
            ]);
    }

    public function add()
    {
        $trajet = new Trajet();
        $trajet->motif=request('motif');
        $trajet->datedebut=request('datedebut');
        $trajet->heuredebut=request('heuredebut').":00";
        $trajet->lieudebut=request('lieudebut');
        $trajet->kilometragedebut=request('kilometragedebut');
        $trajet->heurefin=request('heurefin').":00";
        $trajet->datefin=request('datefin');
        $trajet->lieufin=request('lieufin');
        $trajet->kilometragefin=request('kilometragefin');
        $trajet->montantcarburant=request('montantcarburant');
        $trajet->quantitecarburant=request('quantitecarburant');
        $trajet->idvehicule=request('vehicule');
        $trajet->idchauffeur=Session::get('idchauffeur');
        $erreur = "";
        $vehicule = Vehicule::all();
        if($trajet->kilometragedebut < 0 || $trajet->kilometragefin < 0){
            $erreur = "La valeur des kilometrages doit etre positif";
            return view('trajet.add',
            [
                'erreur' => $erreur,
                'vehicule' => $vehicule
            ]);
        }
        if($trajet->kilometragedebut > $trajet->kilometragefin){
            $erreur = "Valeur de kilometrage incoherent";
            return view('trajet.add',
            [
                'erreur' => $erreur,
                'vehicule' => $vehicule
            ]);
        }

        //Calcul difference entre deux time
        //SELECT EXTRACT(EPOCH FROM (heurefin - heuredebut)) / 3600 AS diff_hours from trajet
        if($trajet->vitessemoyenne > 72){
            $erreur = "Vitesse moyenne trop élevée";
            return view('trajet.add',
            [
                'erreur' => $erreur,
                'vehicule' => $vehicule
            ]);
        }
        if($trajet->kilometragedebut > 0 && $trajet->kilometragefin > 0 && $trajet->kilometragedebut < $trajet->kilometragefin && $trajet->vitessemoyenne <= 72){
            $trajet->save();
            $trajet = Trajet::liste();
            return view('trajet.liste',
            [
                'trajet' => $trajet
            ]);
        }
    }

}
