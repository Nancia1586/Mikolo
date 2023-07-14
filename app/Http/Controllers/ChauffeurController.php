<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $email=request('email');
        $mdp=request('mdp');
        $id = Chauffeur::login($email,$mdp);
        if($id == -1){
            return view('chauffeur.login',
            [
                'error' => 'Email ou mot de passe incorrect'
            ]);
        }
        Session::put('idchauffeur', $id);
        return redirect('/chauffeur/home');
    }

    public function inscription()
    {
        $chauffeur = new Chauffeur();
        $chauffeur->nom=request('nom');
        $chauffeur->email=request('email');
        $chauffeur->mdp=md5(request('mdp'));
        $mdp2=request('mdp2');
        if($mdp2 != request('mdp')){
            return view('chauffeur.inscription',
            [
                'error' => 'Les mots de passes que vous avez saisi sont différents'
            ]);
        }
        $chauffeur->save();
        return view('chauffeur.login');
    }

    // public function login(){
    //     $datetime = '2023-04-23 12:22:00';
    //     $datetime2 = '2023-03-15 12:22:00';
    //     $date = \Carbon\Carbon::parse($datetime);
    //     $date2 = \Carbon\Carbon::parse($datetime2);
    //     if($date->isBefore($date2)){
    //         echo "date < date2";
    //     }
    //     else{
    //         echo "date > date2";
    //     }
    // }

    public function inscriptionform(){
        return view('chauffeur.inscription');
    }

    public function home(){
        return view('chauffeur.home');
    }
}
