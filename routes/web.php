<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view(
//         'utilisateur.login',
//         [
//             'id' => '1'
//         ]
//     );
// });

Route::get('/',[UtilController::class,'ajoutpanier']);

Route::auto('/chauffeur',ChauffeurController::class);
Route::auto('/vehicule',VehiculeController::class);
Route::auto('/trajet',TrajetController::class);
Route::auto('/echeance',EcheanceController::class);
Route::auto('/util',UtilController::class);
Route::auto('/email',EmailController::class);

Route::auto('/utilisateur',UtilisateurController::class);
Route::auto('/admin',AdminController::class);
Route::auto('/laptop',LaptopController::class);
Route::auto('/pointvente',PointVenteController::class);
Route::auto('/processeur',ProcesseurController::class);
Route::auto('/marque',MarqueController::class);
Route::auto('/ram',RamController::class);
Route::auto('/ecran',EcranController::class);
Route::auto('/disquedur',DisqueDurController::class);
Route::auto('/magasin',MagasinController::class);
Route::auto('/vente',VenteController::class);
Route::auto('/statistique',StatistiqueController::class);
