<?php

namespace App\Http\Controllers;

use App\Models\DisqueDur;
use App\Models\TypeDisqueDur;
use App\Models\TypeEcheance;
use App\Models\Echeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DisqueDurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listetype()
    {
        $type = request('type');

        $liste = DisqueDur::from("typedisquedur");

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $type = $liste->paginate(4);
        $type->appends(request()->query());
        return view('disquedur.liste_type',
            [
                'type' => $type
            ]);
    }

    public function add_type()
    {
        $type = new TypeDisqueDur();
        $type->type=request('type');
        $type->save();
        return redirect('/disquedur/listetype');
    }

    public function update_type()
    {
        $type = TypeDisqueDur::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $type->update([
            'type' => request('type')
        ]);
        return redirect('/disquedur/listetype');
    }

    public function supprimer_type()
    {
        $type = TypeDisqueDur::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $type->delete();
        return redirect('/disquedur/listetype');
    }

}
