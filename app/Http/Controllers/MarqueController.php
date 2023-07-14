<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\TypeEcheance;
use App\Models\Echeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function liste()
    {
        $marque = request('marque');

        $liste = Marque::from("marque");

        if ($marque) {
            $liste->whereRaw('lower(marque) like ?', ["%".strtolower($marque)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $marque = $liste->paginate(4);
        $marque->appends(request()->query());
        return view('marque.liste',
            [
                'marque' => $marque
            ]);
    }

    public function add()
    {
        $marque = new Marque();
        $marque->marque=request('marque');
        $marque->save();
        return redirect('/marque/liste');
    }

    public function update()
    {
        $marque = Marque::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $marque->update([
            'marque' => request('marque')
        ]);
        return redirect('/marque/liste');
    }

    public function supprimer()
    {
        $marque = Marque::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $marque->delete();
        return redirect('/marque/liste');
    }
}
