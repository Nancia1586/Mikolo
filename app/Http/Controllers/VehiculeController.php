<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Marque;
use App\Models\TypeVehicule;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use FPDF;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        $numero = request('numero');
        $marque = request('marque');
        $modele = request('modele');
        $type = request('type');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Vehicule::from("v_typemarquevehicule");

        if ($numero) {
            $liste->whereRaw('lower(numero) like ?', ["%".strtolower($numero)."%"]);

        }
        if ($marque) {
            $liste->whereRaw('lower(marque) like ?', ["%".strtolower($marque)."%"]);

        }
        if ($modele) {
            $liste->whereRaw('lower(modele) like ?', ["%".strtolower($modele)."%"]);

        }
        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(numero) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(marque) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(modele) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(type) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->orderBy('id', 'asc');
        $vehicule = $liste->paginate(2);
        $vehicule->appends(request()->query());
        $liste_marque = Marque::all();
        $liste_type = TypeVehicule::all();
        return view('vehicule.liste',
            [
                'vehicule' => $vehicule,
                'marque' => $liste_marque,
                'type' => $liste_type
            ]);
    }

    public function add()
    {
        $vehicule = new Vehicule();
        $vehicule->numero=request('numero');
        $vehicule->idmarque=request('marque');
        $vehicule->modele=request('modele');
        $vehicule->idtype=request('type');
        $vehicule->save();
        return redirect('/vehicule/liste');
    }

    public function update()
    {
        $vehicule = Vehicule::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $vehicule->update([
            'numero' => request('numero'),
            'idmarque' => request('marque'),
            'modele' => request('modele'),
            'idtype' => request('type')
        ]);
        return redirect('/vehicule/liste');
    }

    public function supprimer()
    {
        $vehicule = Vehicule::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $vehicule->delete();
        return redirect('/vehicule/liste');
    }

    public function disponible()
    {
        $side = '';
        if(request('user') == 0){
            $side = 'side';
        }
        if(request('user') == 1){
            $side = 'adside';
        }

        if(request('side') != null){
            $side = request('side');
        }

        $date = "";
        if(request('date') != null){
            $date = request('date');
        }

        $dispo = Vehicule::disponible($date);
        return view('vehicule.disponible',
            [
                'dispo' => $dispo,
                'side' => $side
            ]);
    }

    public function voirpdftrajet()
    {
        $idvehicule = request('idvehicule');
        $vehicule = Vehicule::get($idvehicule);
        $trajet = Trajet::get($idvehicule);
        return view('vehicule.pdftrajet', [
            'title' => 'Liste des trajets',
            'vehicule' => $vehicule,
            'trajet' => $trajet
        ]);
    }

    public function generatepdftrajet()
    {
        $idvehicule = request('idvehicule');
        $vehicule = Vehicule::get($idvehicule);
        $trajet = Trajet::get($idvehicule);

        //Export pdf
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',14);

        $pdf->Header();

        // Titre du tableau au centre
        // $pdf->Cell(100,10,'Liste des trajets');
        $texte = "Liste des trajets";
        $largeur_texte = $pdf->GetStringWidth($texte);
        $pdf->SetX((210 - $largeur_texte) / 2);
        $pdf->Cell($largeur_texte, 10, $texte, 0, 1, 'C');
        $pdf->Ln(); // Aller à la ligne

        //Details
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(100, 10, 'Numero: '.$vehicule[0]['numero']);
        $pdf->Ln(); // Aller à la ligne
        $pdf->Cell(100, 10, 'Marque: '.$vehicule[0]['marque']);
        $pdf->Ln(); // Aller à la ligne
        $pdf->Cell(100, 10, 'Modele: '.$vehicule[0]['modele']);
        $pdf->Ln(); // Aller à la ligne
        $pdf->Cell(100, 10, 'Type: '.$vehicule[0]['type']);
        $pdf->Ln(); // Aller à la ligne

        $pdf->SetFont('Arial','B',11);
        // En-têtes de colonne
        $pdf->Cell(35, 10, 'Date', 1);
        $pdf->Cell(35, 10, 'Motif', 1);
        $pdf->Cell(35, 10, 'Depart', 1);
        $pdf->Cell(35, 10, 'Arrivee', 1);
        $pdf->Cell(35, 10, 'Chauffeur', 1);
        $pdf->Ln(); // Aller à la ligne

        // Données du tableau
        $pdf->SetFont('Arial', '', 10); // Utiliser une police normale pour les données
        foreach($trajet as $row){
            $pdf->Cell(35, 10, $row['datedebut'], 1);
            $pdf->Cell(35, 10, $row['motif'], 1);
            $pdf->Cell(35, 10, $row['lieudebut'], 1);
            $pdf->Cell(35, 10, $row['lieufin'], 1);
            $pdf->Cell(35, 10, $row['nom'], 1);
            $pdf->Ln(); // Aller à la ligne
        }

        $pdfContent = $pdf->Output('S');
        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="nom-du-fichier.pdf"'
        ]);

    }

    //DOMPDF
    public function showpdf()
    {
        try {
            $pdf = new DomPDF();
            // $pdf->loadHtml($content->html);
            $idvehicule = request('idvehicule');
            $vehicule = Vehicule::get($idvehicule);
            $trajet = Trajet::get($idvehicule);
            $pdf->loadHtml(view('vehicule.pdftrajet', [
                'trajet' => $trajet,
                'vehicule' => $vehicule
            ]));
            $pdf->render();
            $output = $pdf->output();
            return response($output, 200)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function exportcsv()
    {
        $idvehicule = request('idvehicule');
        $data = DB::select("select * from v_vehiculechauffeurtrajet where idvehicule = ".$idvehicule); // requête pour récupérer toutes les données de la table
        // $data = \DB::table('vehicule')
        //         ->select('vehicule.*','typevehicule.*')
        //         ->join('typevehicule', 'typevehicule.id', '=', 'vehicule.typevehiculeid')
        //         ->get();
        // $data = $query->get();
        $headers = array_keys((array) $data[0]);
        $csv = Writer::createFromString('', 'w+');
        $csv->setDelimiter(';');
        $csv->setNewline("\n");
        $csv->insertOne($headers);

        foreach ($data as $row)
        {
            $csv->insertOne((array) $row);
        }
        $response = new \Illuminate\Http\Response($csv->__toString());
        $response->header('Content-Type', 'text/html');
        $response->header('Content-Disposition', 'attachment; filename="trajet.csv"');



        return $response;
    }

}
