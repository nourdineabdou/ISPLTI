<?php

use App\Http\Controllers\MealCategoryController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\CommendeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SortiController;
use App\Http\Controllers\DechetController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'prefix' => 'commandes'], function () {
    Route::get('', [CommendeController::class, 'index'])->name('commendes.index');
    Route::get('show/{commende}', [CommendeController::class, 'show'])->name('commendes.show');
    Route::ajaxCreate('create', [CommendeController::class, 'create'])->name('commendes.create');
    Route::post('store', [CommendeController::class, 'store'])->name('commendes.store');
    Route::ajaxEdit('edit/{commende}', [CommendeController::class, 'edit'])->name('commendes.edit');
    Route::put('update/{commende}', [CommendeController::class, 'update'])->name('commendes.update');
    Route::delete('destroy/{commende}', [CommendeController::class, 'destroy'])->name('commendes.destroy');

    // meals.products.create
     Route::get('details/create/{id}', [CommendeController::class, 'createDetails'])->name('commendes.details.create');
    // getDetails
    Route::get('get-details/{commende}', [CommendeController::class, 'getDetails'])->name('commendes.get-details');
    // commende.detaille.update
    Route::post('details/update/{commende}', [CommendeController::class, 'updateDetails'])->name('commendes.details.update');
    // commende.detaille.store
    Route::post('details/store/{commende}', [CommendeController::class, 'storeDetails'])->name('commendes.details.store');
    // commende.detaille.destroy
    Route::delete('details/destroy/{detail}', [CommendeController::class, 'destroyDetails'])->name('commendes.details.destroy');
    Route::get('valider/{commende}', [CommendeController::class, 'valider'])->name('commendes.valider');

});

Route::group(['middleware' => ['auth'], 'prefix' => 'sorti'], function () {
   // Route::get('transaction', [SortiController::class, 'check']);

    Route::get('', [SortiController::class, 'index'])->name('sorti.index');
    Route::get('show/{commende}', [SortiController::class, 'show'])->name('sorti.show');
    Route::ajaxCreate('create', [SortiController::class, 'create'])->name('sorti.create');
    Route::post('store', [SortiController::class, 'store'])->name('sorti.store');
    Route::ajaxEdit('edit/{commende}', [SortiController::class, 'edit'])->name('sorti.edit');
    Route::put('update/{commende}', [SortiController::class, 'update'])->name('sorti.update');
    Route::delete('destroy/{commende}', [SortiController::class, 'destroy'])->name('sorti.destroy');
     // /products/${productId}/commande-row
     Route::get('{product}/{commande}/commande-row', [SortiController::class, 'commandeRow'])->name('sorti.commande-row');
    // meals.products.create
     Route::get('details/create/{id}', [SortiController::class, 'createDetails'])->name('sorti.details.create');
    // getDetails
    Route::get('get-details/{commende}', [SortiController::class, 'getDetails'])->name('sorti.get-details');
    // commende.detaille.update
    Route::post('details/update/{commende}', [SortiController::class, 'updateDetails'])->name('sorti.details.update');
    // commende.detaille.store
    Route::post('details/store/{commende}', [SortiController::class, 'storeDetails'])->name('sorti.details.store');
    // commende.detaille.destroy
    Route::delete('details/destroy/{detail}', [SortiController::class, 'destroyDetails'])->name('sorti.details.destroy');
    Route::get('valider/{commende}', [SortiController::class, 'valider'])->name('sorti.valider');
   Route::get('getEmballage/{id}', [SortiController::class, 'getEmballage'])->name('sorti.getEmballage');
   Route::get('getEmballage/{id}', [SortiController::class, 'getEmballage'])->name('sorti.getEmballage');
    //get nombre de produit par emballage
    Route::get('getNombreProduit/{prod}/{emb}', [SortiController::class, 'getNbrproduitParEmballage'])->name('sorti.getNombreProduit');
});

Route::get('testOrdeur', [CaisseController::class, 'testOrder']);

Route::group(['middleware' => ['auth'], 'prefix' => 'caisses'], function () {
    Route::get('', [CaisseController::class, 'index'])->name('caisses.index');
    Route::get('show/{caisse}', [CaisseController::class, 'show'])->name('caisses.show');
    Route::ajaxCreate('create', [CaisseController::class, 'create'])->name('caisses.create');
    Route::post('store', [CaisseController::class, 'store'])->name('caisses.store');
    Route::get('edit/{caisse}', [CaisseController::class, 'edit'])->name('caisses.edit');
    Route::ajaxEdit('edit/temporaire/{caisse}', [CaisseController::class, 'edit_temporaire'])->name('caisses.edit_temporaire');
    Route::put('update/{caisse}', [CaisseController::class, 'update'])->name('caisses.update');
    Route::put('update/temporaire/{caisse}', [CaisseController::class, 'update_temporaire'])->name('caisses.temporaire');
    Route::delete('destroy/{caisse}', [CaisseController::class, 'destroy'])->name('caisses.destroy');
    Route::get('horaire/valider/{horaire}', [CaisseController::class, 'active_horaire'])->name('caisses.valider_horaire');
    Route::get('horaire/liste', [CaisseController::class, 'horaires'])->name('caisses.horaire');
    // details horaire
    Route::get('horaire/details/{horaire}', [CaisseController::class, 'horaireDetails'])->name('caisses.horaire.details');
    // excedent sur un horaire format
    Route::get('horaire/excedent', [CaisseController::class, 'excedentHoraire'])->name('caisses.horaire.excedent');
    // enregistrer un excedent sur un horaire
    Route::ajaxCreate('horaire/excedent/create', [CaisseController::class, 'createExcedentHoraire'])->name('caisses.horaire.excedent.create');
    // store excedent horaire
    Route::post('horaire/excedent/store', [CaisseController::class, 'storeExcedentHoraire'])->name('caisses.horaire.excedent.store');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'clients'], function () {
    Route::get('', [ClientController::class, 'index'])->name('clients.index');
    Route::get('show/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::ajaxCreate('create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('store', [ClientController::class, 'store'])->name('clients.store');
    Route::ajaxEdit('edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('update/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('destroy/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});


Route::group(['middleware' => ['auth'], 'prefix' => 'fournisseurs'], function () {
    Route::get('', [FournisseurController::class, 'index'])->name('fournisseurs.index');
    Route::get('show/{fournisseur}', [FournisseurController::class, 'show'])->name('fournisseurs.show');
    Route::ajaxCreate('create', [FournisseurController::class, 'create'])->name('fournisseurs.create');
    Route::post('store', [FournisseurController::class, 'store'])->name('fournisseurs.store');
    Route::ajaxEdit('edit/{fournisseur}', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
    Route::put('update/{fournisseur}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
    Route::delete('destroy/{fournisseur}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'stocks'], function () {
    Route::get('', [StockController::class, 'index'])->name('stocks.index');
    Route::get('show/{stock}', [StockController::class, 'show'])->name('stocks.show');
    Route::ajaxCreate('create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('store', [StockController::class, 'store'])->name('stocks.store');
    Route::ajaxEdit('edit/{stock}', [StockController::class, 'edit'])->name('stocks.edit');
    Route::put('update/{stock}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('destroy/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');
    Route::get('systeme/etat', [StockController::class, 'systeme'])->name('stocks.systeme');

});

// employees
Route::group(['middleware' => ['auth'], 'prefix' => 'employees'], function () {
    Route::get('', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('show/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::ajaxCreate('create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::ajaxEdit('edit/{employee}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('update/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('destroy/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'dechets'], function () {
    Route::get('', [DechetController::class, 'index'])->name('dechets.index');
    Route::get('show/{dechet}', [DechetController::class, 'show'])->name('dechets.show');
    Route::ajaxCreate('create', [DechetController::class, 'create'])->name('dechets.create');
    Route::post('store', [DechetController::class, 'store'])->name('dechets.store');
    Route::ajaxEdit('edit/{dechet}', [DechetController::class, 'edit'])->name('dechets.edit');
    Route::put('update/{dechet}', [DechetController::class, 'update'])->name('dechets.update');
    Route::delete('destroy/{dechet}', [DechetController::class, 'destroy'])->name('dechets.destroy');

});
