<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\BachelierController;
use App\Http\Controllers\ActualiteController;

// route groupe etudiant
Route::group(['middleware' => ['auth'], 'prefix' => 'etudiants'], function () {
    Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::get('/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');
    Route::get('/{id}/valider', [EtudiantController::class, 'valider'])->name('etudiants.valider');
    // exporter
    Route::get('/exporter/etudiants', [EtudiantController::class, 'exporter'])->name('etudiants.exporter');
    // importer
    Route::get('/importer/etudiants', [EtudiantController::class, 'importer'])->name('etudiants.importer');
    Route::post('/importer/etudiants', [EtudiantController::class, 'importerStore'])->name('etudiants.importer.store');
    Route::get('/image/{id}', [EtudiantController::class, 'getImage']);
    // attestation pdf etudiant
    Route::get('/{id}/attestation', [EtudiantController::class, 'attestation'])->name('etudiants.attestation');

    // emplois etudiant
    Route::get('emplois/du_temps', [EtudiantController::class, 'emploiDuTemps'])->name('etudiants.emplois');
    Route::post('/emplois/du_temps', [EtudiantController::class, 'storeEmploiDuTemps'])->name('etudiants.emploi_du_temps_store');

    // export le dossier etudiant
    Route::get('/{id}/exporter_dossier', [EtudiantController::class, 'downloadFolder'])->name('etudiants.exporter_dossier');
});

// bacheliers routes

Route::group(['middleware' => ['auth'], 'prefix' => 'bacheliers'], function () {
    Route::get('/', [BachelierController::class, 'index'])->name('bacheliers.index');
    Route::get('/create', [BachelierController::class, 'create'])->name('bacheliers.create');
    Route::get('/{id}', [BachelierController::class, 'show'])->name('bacheliers.show');
    Route::get('/{id}/valider', [BachelierController::class, 'valider'])->name('bacheliers.valider');
    // exporter
    Route::get('/exporter/bacheliers', [BachelierController::class, 'exporter'])->name('bacheliers.exporter');
    // importer
    Route::get('/importer/bacheliers', [BachelierController::class, 'importer'])->name('bacheliers.importer');
    Route::post('/importer/bacheliers', [BachelierController::class, 'importerStore'])->name('bacheliers.importer.store');
    Route::post('/exporter/bacheliers', [BachelierController::class, 'exporterStore'])->name('bacheliers.exporter.store');
    Route::get('/image/{id}', [BachelierController::class, 'getImage']);
    // import et export excel
    Route::post('/import', [BachelierController::class, 'import'])->name('bacheliers.import');
    Route::get('/export', [BachelierController::class, 'export'])->name('bacheliers.export');

    // attestation pdf bachelier
    Route::get('/{id}/attestation', [BachelierController::class, 'attestation'])->name('bacheliers.attestation');
    // exporter le dossier bachelier
    Route::get('/{id}/exporter_dossier', [BachelierController::class, 'downloadFolder'])->name('bacheliers.exporter_dossier');
});


// fin routes etudiant

// route groupe actualites
Route::group(['middleware' => ['auth'], 'prefix' => 'news'], function () {
    Route::get('/', [App\Http\Controllers\ActualiteController::class, 'index'])->name('actualites.index');
    Route::get('/create', [App\Http\Controllers\ActualiteController::class, 'create'])->name('actualites.create');
    Route::post('/store', [App\Http\Controllers\ActualiteController::class, 'store'])->name('actualites.store');
    Route::get('/{id}/edit', [App\Http\Controllers\ActualiteController::class, 'edit'])->name('actualites.edit');
    Route::put('/{id}/update', [App\Http\Controllers\ActualiteController::class, 'update'])->name('actualites.update');
    Route::get('/{id}/statut', [App\Http\Controllers\ActualiteController::class, 'statut'])->name('actualites.statut');
});

//
