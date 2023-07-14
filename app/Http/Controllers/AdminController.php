<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loginform(){
        return view('admin.login');
    }

    public function login()
    {
        $email=request('email');
        $mdp=request('mdp');
        $id = Admin::login($email,$mdp);
        if($id == -1){
            return view('admin.login',
            [
                'error' => 'Email ou mot de passe incorrect'
            ]);
        }
        Session::put('idadmin', $id);
        return redirect('/laptop/liste');
    }

    public function home(){
        return view('admin.home');
    }
}
