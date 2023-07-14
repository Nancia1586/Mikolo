<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\TypeEcheance;
use App\Models\Echeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EcheanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vehicule()
    {
        $vehicule = Vehicule::liste();
        return view('echeance.vehicule',
            [
                'vehicule' => $vehicule
            ]);
    }

    public function type()
    {
        $idvehicule = request('idvehicule');
        Session::put('idvehicule',$idvehicule);
        $type = TypeEcheance::all();
        return view('echeance.type',
            [
                'type' => $type
            ]);
    }

    public function liste()
    {
        if(request('type') != null){
            $type = request('type');
            Session::put('idtypeecheance',$type);
        }
        $echeance = Echeance::liste(Session::get('idvehicule'),Session::get('idtypeecheance'));
        return view('echeance.liste',
            [
                'echeance' => $echeance,
                'idvehicule' => Session::get('idvehicule'),
                'idtypeecheance' => Session::get('idtypeecheance')
            ]);
    }

    public function add()
    {
        $echeance = new echeance();
        $echeance->debut=request('debut');
        $echeance->fin=request('fin');
        $echeance->idvehicule=request('idvehicule');
        $echeance->idtypeecheance=request('idtypeecheance');
        $echeance->montant=request('montant');
        $echeance->save();
        return redirect('/echeance/liste');
    }

    public function situation_type()
    {
        $side = '';
        if(request('user') == 0){
            $side = 'side';
        }
        if(request('user') == 1){
            $side = 'adside';
        }
        Session::put('side',$side);
        $type = TypeEcheance::all();
        return view('echeance.situation_type',
            [
                'type' => $type,
                'side' => $side
            ]);
    }

     public function situation_liste()
    {
        $idtypeecheance = request('type');
        $side = Session::get('side');
        $liste = Echeance::situation($idtypeecheance);
        return view('echeance.situation_liste',
            [
                'liste' => $liste,
                'side' => $side
            ]);
    }
}
