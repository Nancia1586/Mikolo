<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Vente;
use App\Models\Commission;
use App\Models\PointVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function totalventeglobal()
    {
        $mois = Mois::all();
        $annee = 2023;
        if(request('annee')){
            $annee = request('annee');
        }
        $liste = Vente::totalventeglobal($annee);
        $listeannee = Vente::anneeventeglobal();
        return view('statistique.totalventeglobal',
            [
                'mois' => $mois,
                'liste' => $liste,
                'listeannee' => $listeannee
            ]);
    }

    public function totalventepv()
    {
        $mois = Mois::all();
        $annee = 2023;
        if(request('annee')){
            $annee = request('annee');
        }
        $idpv = PointVente::firstid();
        if(request('idpv')){
            $idpv = request('idpv');
        }
        $liste = Vente::totalventeparpv($idpv, $annee);
        $pointvente = PointVente::all();
        $listeannee = Vente::anneeventeglobal();
        return view('statistique.totalventepv',
            [
                'mois' => $mois,
                'liste' => $liste,
                'pointvente' => $pointvente,
                'listeannee' => $listeannee
            ]);
    }

    public function benefice()
    {
        $mois = Mois::all();
        $annee = 2023;
        if(request('annee')){
            $annee = request('annee');
        }
        $liste = Vente::totalbeneficeglobal($annee);
        $listeannee = Vente::anneeventeglobal();
        return view('statistique.benefice',
            [
                'mois' => $mois,
                'liste' => $liste,
                'listeannee' => $listeannee
            ]);
    }

    //PDF
    public function venteglobalpdf()
    {
        try {
            $pdf = new DomPDF();
            // $pdf->loadHtml($content->html);
            $mois = Mois::all();
            $annee = 2023;
            if(request('annee')){
                $annee = request('annee');
            }
            $liste = Vente::totalventeglobal($annee);
            $pdf->loadHtml(view('statistique.venteglobalpdf', [
                'mois' => $mois,
                'liste' => $liste
            ]));
            $pdf->render();
            $output = $pdf->output();
            return response($output, 200)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function ventepvpdf()
    {
        try {
            $pdf = new DomPDF();
            // $pdf->loadHtml($content->html);
            $mois = Mois::all();
            $annee = 2023;
            if(request('annee')){
                $annee = request('annee');
            }
            $idpv = PointVente::firstid();
            if(request('idpv')){
                $idpv = request('idpv');
            }
            $liste = Vente::totalventeparpv($idpv, $annee);
            $pointvente = PointVente::all();
            $emplacement = PointVente::getbyid($idpv);
            $pdf->loadHtml(view('statistique.ventepvpdf', [
                'mois' => $mois,
                'liste' => $liste,
                'pointvente' => $pointvente,
                'emplacement' => $emplacement
            ]));
            $pdf->render();
            $output = $pdf->output();
            return response($output, 200)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function beneficepdf()
    {
        try {
            $pdf = new DomPDF();
            $annee = 2023;
            if(request('annee')){
                $annee = request('annee');
            }
            // $pdf->loadHtml($content->html);
            $mois = Mois::all();
            $liste = Vente::totalbeneficeglobal($annee);
            $pdf->loadHtml(view('statistique.beneficepdf', [
                'mois' => $mois,
                'liste' => $liste
            ]));
            $pdf->render();
            $output = $pdf->output();
            return response($output, 200)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function commission()
    {
        $pointvente = PointVente::all();
        $listemois = Mois::all();
        $annee = 2023;
        if(request('annee')){
            $annee = request('annee');
        }
        $mois = 5;
        if(request('mois')){
            $mois = request('mois');
        }
        return view('statistique.commission',
            [
                'mois' => $mois,
                'annee' => $annee,
                'pointvente' => $pointvente,
                'listemois' => $listemois
            ]);
    }


    //Export csv avec somme any amin'ny farany
    public function beneficecsv()
    {
        $data = Vente::from("v_beneficeglobaltoutmoisannee");//->get(); //\DB::select("SELECT * FROM laptop");
        $data = $data->whereRaw('annee = ?', [request('annee')]);
        $data = $data->get();
        $entete = $data[0];
        ////////////// Tsy maintsy atao anzao ny premiere ligne [0]
        $entete->commission = Commission::totalcommission($data[0]->mois, $data[0]->annee, $data[0]->totalvente);
        $entete->beneficeaprescommission = $data[0]->benefice - Commission::totalcommission($data[0]->mois, $data[0]->annee, $data[0]->totalvente);

        /////////////Headers

        $headers = array_keys($entete->getAttributes());
        // dump($headers)/;
        $csv = Writer::createFromString('', 'w+');
        $csv->setDelimiter(';');
        $csv->setNewline("\n");
        $csv->insertOne($headers);
        // $i = 0;
        $t_commission = 0;
        $t_beneficecommission = 0;
        foreach ($data as $row) {
            ///Settena maina be otrzao le attribut commission satria tsy avy anaty base
            $row->commission = Commission::totalcommission($row->mois, $row->annee, $row->totalvente);
            $row->beneficeaprescommission =  $row->benefice - Commission::totalcommission($row->mois, $row->annee, $row->totalvente);

            ///// Sommena le commission atao any am farany sy benefice avec commssion
            $t_beneficecommission += $row->benefice - Commission::totalcommission($row->mois, $row->annee, $row->totalvente);
            $t_commission += Commission::totalcommission($row->mois, $row->annee, $row->totalvente);
            $csv->insertOne($row->toArray());

        }

        /////////Reto le total efa sum() par colonne atao any farany
        $somme = Vente::from("v_beneficeglobaltoutmoisannee");
        $somme = $somme->whereRaw('annee = ?', [request('annee')]);
        $somme = $somme->get();

        $totalbeneficeavecperte = $somme->sum("benefice");
        $totalperte = $somme->sum("perte");
        $total = [
            'id' => '',
            'numero' => '',
            'nom' => '',
            'abreviation' => '',
            'annee' => '',
            'quantite' => $somme->sum("quantite"),
            'totalvente' => $somme->sum("totalvente"),
            'totalachat' => $somme->sum("totalachat"),
            'mois' => '',
            'beneficebrute' => $somme->sum("beneficebrute"),
            'perte' => $somme->sum("perte"),
            'benefice' => $somme->sum("benefice"),
            'commission' => $t_commission,
            'beneficeaprescommission' => $t_beneficecommission
        ];

        $csv->insertOne($total);
        // ->sum("totalperte");
        // echo $totalperte;
        $response = new \Illuminate\Http\Response($csv->__toString());
        $response->header('Content-Type', 'text/html');
        $response->header('Content-Disposition', 'attachment; filename="benefice.csv"');

        return $response;
    }

}
