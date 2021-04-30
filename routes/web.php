<?php

use App\Http\Controllers\FormationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProduitsController;
use App\Mail\AjoutProduit;
use App\Models\Produit;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[MainController::class,'accueil'])->name('accueil');

Route::middleware(['auth','isAdmin'])->group(function(){
    
});
Route::resource('produits', ProduitsController::class);

Route::get('update-produit', [FormationController::class, 'updateProduit']);
Route::get('index', [FormationController::class, 'index']);
Route::get('ajouter-produit', [FormationController::class, 'ajouterProduit']);
Route::get('ajouter-produit-2', [FormationController::class, 'ajouterProduit2']);

Route::get('update-produit-2/{produit}', [FormationController::class, 'updateProduit2']);
Route::get('suppression-produit', [FormationController::class, 'suppressionProduit']);

Route::get("export", [ProduitsController::class, 'export'])->name('export');

Route::get("test-mail", function(){
    return new AjoutProduit(Produit::orderByDesc('id')->first());

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
