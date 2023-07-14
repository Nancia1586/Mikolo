<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use App\Models\Util;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use FPDF;
use Illuminate\Support\Facades\DB;

class UtilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function recherche_multicritere()
    // {
    //     $req = "select * from auteur where 1 = 1";
    //     if(request('nom') != null){
    //         $req = $req + " and nom = '".request('nom')."'";
    //     }
    //     if(request('prenoms') != null){
    //         $req = $req + " and prenoms = '".request('prenoms')."'";
    //     }
    //     if(request('email') != null){
    //         $req = $req + " and email = '".request('email')."'";
    //     }
    //     $result = Util::recherche_multicritere($req);
    //     return view('result_search',
    //     [
    //         'result' => $result
    //     ]);
    // }

    public function uploadform(Request $request)
    {
        return view('util.upload');
    }

    public function upload(Request $request)
    {
        $file = $request->file('image');
        $destinationPath = 'uploads';
        $photo = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());

        // $info = new Info();
        // $info->image = $destinationPath . "/" . $photo;
        // $info->save();
        echo "Photo importée";
    }

    //Ajax view
    // <script type="text/javascript">

    // function find_endroit()
    // {
    //     //création de l'objet XMLHttpRequest
    //     var xhr;
    //     try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    //     catch (e)
    //     {
    //         try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
    //         catch (e2)
    //         {
    //         try {  xhr = new XMLHttpRequest();  }
    //         catch (e3) {  xhr = false;   }
    //         }
    //     }

    //     //Définition des changements d'états
    //     xhr.onreadystatechange  = function()
    //     {
    //     if(xhr.readyState  == 4){
    //             if(xhr.status  == 200) {
    //                 var retour = JSON.parse(xhr.responseText);
    //                 // var option = '';
    //                 // for( $i=0; $i<retour.length; $i++){
    //                 //     option = option + '<option value='+retour[$i].id+'>'+retour[$i].nom+'</option>';
    //                 // }
    //                 // document.getElementById('client_list').innerHTML = option;
    //                 console.log(retour);
    //             } else {
    //                 document.dyn="Error code " + xhr.status;
    //             }
    //         }
    //     };
    // //XMLHttpRequest.open(method, url, async)
    // var mot = document.getElementById("endroit");
    // xhr.open("GET", "trouver_endroit?mot="+mot.value, true);

    // //XMLHttpRequest.send(body)
    // xhr.send(null);
    // }

    // </script>

    public function ajoutpanier(Request $request)
    {
        $liste = Produit::all();
        return view('util.ajoutpanier',
        [
            'produit' => $liste
        ]);
    }

    public function listepanier(Request $request)
    {
        $sessionId = $request->session()->getId();
        $liste = Util::liste_panier($sessionId);
        return view('util.listepanier',[
            'panier' => $liste
        ]);
    }

    //ajout panier mampiasa sessionID
    public function addtocart(Request $request, $productId)
    {
        // Récupérer le produit à ajouter depuis la base de données ou autre source

        // Accéder à l'ID de session
        $sessionId = $request->session()->getId();
        echo $sessionId;

        // Rechercher le panier de l'utilisateur dans la base de données
        $cart = DB::table('panier')
                    ->where('sessionid', $sessionId)
                    ->where('produitid', $productId)
                    ->first();

        if ($cart) {
            // Le panier existe déjà, vous pouvez par exemple mettre à jour la quantité du produit
            // Effectuer les opérations de mise à jour appropriées dans la table des paniers
            DB::table('panier')
                ->where('sessionid', $sessionId)
                ->where('produitid', $productId)
                ->increment('quantite');
        } else {
            // Le panier n'existe pas, créer un nouveau panier avec le produit ajouté
            DB::table('panier')->insert([
                'sessionid' => $sessionId,
                'produitid' => $productId,
                'quantite' => 1,
            ]);
        }

        // // Rediriger ou afficher un message de confirmation
        return redirect()->back()->with('success', 'Le produit a été ajouté au panier.');
    }

    //Incrementer la quantite dans le panier
    public function increment(Request $request, $panierId)
    {
        DB::table('panier')
            ->where('id', $panierId)
            ->increment('quantite');

        return redirect('/util/listepanier');
    }

    //Decrementer la quantite dans le panier
    public function decrement(Request $request, $panierId)
    {
        DB::table('panier')
            ->where('id', $panierId)
            ->decrement('quantite');

        if(Util::ifZero($panierId) == true){
            $panier = Panier::find($panierId); // retrouver l'utilisateur ayant l'ID 1
            $panier->delete();
        }

        return redirect('/util/listepanier');
    }

}
