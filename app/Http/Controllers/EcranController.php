<?php

namespace App\Http\Controllers;

use App\Models\AffichageEcran;
use App\Models\Vehicule;
use App\Models\TypeEcheance;
use App\Models\Echeance;
use App\Models\ResolutionEcran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EcranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listeresolution()
    {
        $resolution = request('resolution');

        $liste = ResolutionEcran::from("resolutionecran");

        if ($resolution) {
            $liste->whereRaw('lower(resolution) like ?', ["%".strtolower($resolution)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $resolution = $liste->paginate(4);
        $resolution->appends(request()->query());
        return view('ecran.liste_resolution',
            [
                'resolution' => $resolution
            ]);
    }

    public function add_resolution()
    {
        $resolution = new ResolutionEcran();
        $resolution->resolution=request('resolution');
        $resolution->save();
        return redirect('/ecran/listeresolution');
    }

    public function update_resolution()
    {
        $resolution = ResolutionEcran::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $resolution->update([
            'resolution' => request('resolution')
        ]);
        return redirect('/ecran/listeresolution');
    }

    public function supprimer_resolution()
    {
        $resolution = ResolutionEcran::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $resolution->delete();
        return redirect('/ecran/listeresolution');
    }

    //Fabriquant
    public function listeaffichage()
    {
        $affichage = request('affichage');

        $liste = AffichageEcran::from("affichageecran");

        if ($affichage) {
            $liste->whereRaw('lower(affichage) like ?', ["%".strtolower($affichage)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $affichage = $liste->paginate(4);
        $affichage->appends(request()->query());
        return view('ecran.liste_affichage',
            [
                'affichage' => $affichage
            ]);
    }

    public function add_affichage()
    {
        $affichage = new AffichageEcran();
        $affichage->affichage=request('affichage');
        $affichage->save();
        return redirect('/ecran/listeaffichage');
    }

    public function update_affichage()
    {
        $affichage = AffichageEcran::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $affichage->update([
            'affichage' => request('affichage')
        ]);
        return redirect('/ecran/listeaffichage');
    }

    public function supprimer_affichage()
    {
        $affichage = AffichageEcran::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $affichage->delete();
        return redirect('/ecran/listeaffichage');
    }
}
