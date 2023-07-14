<?php

namespace App\Http\Controllers;

use App\Models\Ram;
use App\Models\TypeRam;
use App\Models\Echeance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function listetype()
    {
        $type = request('type');

        $liste = Ram::from("typeram");

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->orderBy('id', 'asc');
        $type = $liste->paginate(4);
        $type->appends(request()->query());
        return view('ram.liste_type',
            [
                'type' => $type
            ]);
    }

    public function add_type()
    {
        $type = new TypeRam();
        $type->type=request('type');
        $type->save();
        return redirect('/ram/listetype');
    }

    public function update_type()
    {
        $type = TypeRam::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $type->update([
            'type' => request('type')
        ]);
        return redirect('/ram/listetype');
    }

    public function supprimer_type()
    {
        $type = TypeRam::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $type->delete();
        return redirect('/ram/listetype');
    }
}
