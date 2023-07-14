<?php

namespace App\Http\Controllers;

use App\Models\CoreProcesseur;
use App\Models\Fabriquant;
use App\Models\Echeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProcesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listecore()
    {
        $core = request('core');

        $liste = CoreProcesseur::from("coreprocesseur");

        if ($core) {
            $liste->whereRaw('lower(core) like ?', ["%".strtolower($core)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $core = $liste->paginate(4);
        $core->appends(request()->query());
        return view('processeur.liste_core',
            [
                'core' => $core
            ]);
    }

    public function add_core()
    {
        $core = new CoreProcesseur();
        $core->core=request('core');
        $core->save();
        return redirect('/processeur/listecore');
    }

    public function update_core()
    {
        $core = CoreProcesseur::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $core->update([
            'core' => request('core')
        ]);
        return redirect('/processeur/listecore');
    }

    public function supprimer_core()
    {
        $core = CoreProcesseur::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $core->delete();
        return redirect('/processeur/listecore');
    }

    //Fabriquant
    public function listefabriquant()
    {
        $fabriquant = request('fabriquant');

        $liste = Fabriquant::from("fabriquant");

        if ($fabriquant) {
            $liste->whereRaw('lower(fabriquant) like ?', ["%".strtolower($fabriquant)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $fabriquant = $liste->paginate(4);
        $fabriquant->appends(request()->query());
        return view('processeur.liste_fabriquant',
            [
                'fabriquant' => $fabriquant
            ]);
    }

    public function add_fabriquant()
    {
        $fabriquant = new Fabriquant();
        $fabriquant->fabriquant=request('fabriquant');
        $fabriquant->save();
        return redirect('/processeur/listefabriquant');
    }

    public function update_fabriquant()
    {
        $fabriquant = Fabriquant::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $fabriquant->update([
            'fabriquant' => request('fabriquant')
        ]);
        return redirect('/processeur/listefabriquant');
    }

    public function supprimer_fabriquant()
    {
        $fabriquant = Fabriquant::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $fabriquant->delete();
        return redirect('/processeur/listefabriquant');
    }
}
