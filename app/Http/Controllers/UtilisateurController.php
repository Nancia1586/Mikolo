<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Utilisateur;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UtilisateurController extends Controller
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
        $id = Utilisateur::login($email,$mdp);
        if($id == -1){
            return view('utilisateur.login',
            [
                'error' => 'Email ou mot de passe incorrect'
            ]);
        }
        $pointvente = Utilisateur::getpointvente($id);
        if($pointvente == -1){
            return view('utilisateur.login',
            [
                'error' => 'Votre acces a été refusé'
            ]);
        }
        Session::put('idpointvente', $pointvente);
        Session::put('idutilisateur', $id);
        return redirect('/pointvente/reception');
    }

    public function add_user()
    {
        $type = new Utilisateur();
        $type->nom=request('nom');
        $type->email=request('email');
        $type->mdp=md5(request('mdp'));
        $type->save();
        // return redirect('/disquedur/listetype');
    }

    public function add_client()
    {
        $type = new Client();
        $type->nom=request('nom');
        $type->contact=request('contact');
        // $type->mdp=md5(request('mdp'));
        $type->save();
        // return redirect('/disquedur/listetype');
    }
}
