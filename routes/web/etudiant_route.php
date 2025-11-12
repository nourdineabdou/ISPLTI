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
    Route::get('/{id}/rejeter', [EtudiantController::class, 'rejeter'])->name('etudiants.rejeter');
    // edit
    Route::get('/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    // update
    Route::put('/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
    // exporter
    Route::get('/exporter/etudiants', [EtudiantController::class, 'exporter'])->name('etudiants.exporter');
    // importer
    Route::get('/importer/etudiants', [EtudiantController::class, 'importer'])->name('etudiants.importer');
    Route::post('/importer/etudiants', [EtudiantController::class, 'importerStore'])->name('etudiants.importer.store');
    // attestation pdf etudiant

    // emplois etudiant
    Route::get('emplois/du_temps', [EtudiantController::class, 'emploiDuTemps'])->name('etudiants.emplois');
    Route::post('/emplois/du_temps', [EtudiantController::class, 'storeEmploiDuTemps'])->name('etudiants.emploi_du_temps_store');

    // export le dossier etudiant
    Route::get('/{id}/exporter_dossier', [EtudiantController::class, 'downloadFolder'])->name('etudiants.exporter_dossier');
    // import inscription adm
    Route::get('/importer/inscriptions_adm', [EtudiantController::class, 'importerInscriptionAdm'])->name('etudiants.importer.inscriptions_adm');
    Route::post('/importer/inscriptions_adm', [EtudiantController::class, 'importerInscriptionAdmStore'])->name('etudiants.importer.inscriptions_adm.store');
    // import inscription pdg
    Route::get('/importer/inscriptions_pdg', [EtudiantController::class, 'importerInscriptionPdg'])->name('etudiants.importer.inscriptions_pdg');
    Route::post('/importer/inscriptions_pdg', [EtudiantController::class, 'importerInscriptionPdgStore'])->name('etudiants.importer.inscriptions_pdg.store');
    // modal pour importer les etudiants
});

// bacheliers routes

Route::group(['middleware' => ['auth'], 'prefix' => 'bacheliers'], function () {
    Route::get('/', [BachelierController::class, 'index'])->name('bacheliers.index');
    // edit
    Route::get('/{id}/edit', [BachelierController::class, 'edit'])->name('bacheliers.edit');
    // update
    Route::put('/{id}', [BachelierController::class, 'update'])->name('bacheliers.update');
    Route::get('/create', [BachelierController::class, 'create'])->name('bacheliers.create');
    Route::get('/{id}', [BachelierController::class, 'show'])->name('bacheliers.show');
    Route::get('/{id}/valider', [BachelierController::class, 'valider'])->name('bacheliers.valider');
    Route::get('/{id}/rejeter', [BachelierController::class, 'rejeter'])->name('bacheliers.rejeter');
    // exporter
    Route::get('/exporter/bacheliers', [BachelierController::class, 'exporter'])->name('bacheliers.exporter');
    // importer
    Route::get('/importer/bacheliers', [BachelierController::class, 'importer'])->name('bacheliers.importer');
    Route::post('/importer/bacheliers', [BachelierController::class, 'importerStore'])->name('bacheliers.importer.store');
    Route::post('/exporter/bacheliers', [BachelierController::class, 'exporterStore'])->name('bacheliers.exporter.store');

    // import et export excel
    Route::post('/import', [BachelierController::class, 'import'])->name('bacheliers.import');
    Route::get('/export', [BachelierController::class, 'export'])->name('bacheliers.export');

    // attestation pdf bachelier

    // exporter le dossier bachelier
    Route::get('/{id}/exporter_dossier', [BachelierController::class, 'downloadFolder'])->name('bacheliers.exporter_dossier');
});
Route::group(['prefix' => 'bacheliers'], function () {
     Route::get('/image/{id}', [BachelierController::class, 'getImage'])->name('bacheliers.image');
    Route::get('/{id}/attestation', [BachelierController::class, 'attestation'])->name('bacheliers.attestation');

});
Route::group(['prefix' => 'etudiants'], function () {
    // absences etudiant
    Route::get('/{nodos}/absences', [EtudiantController::class, 'absences'])->name('etudiants.absences');
    Route::get('/image/{id}', [EtudiantController::class, 'getImage'])->name('etudiants.image');
  Route::get('/{id}/attestation', [EtudiantController::class, 'attestation'])->name('etudiants.attestation');
  // info etudiant par ajax
  Route::get('/info/{id}/etudiant', [EtudiantController::class, 'infoEtudiant'])->name('etudiants.info');
  //copier_dossiers_bacheliers
  Route::get('/copier_dossiers/bacheliers', [EtudiantController::class, 'copier_dossiers_bacheliers'])->name('etudiants.copier_dossiers_bacheliers');
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

//test email bachelier
Route::get('/send-email/{id}', [BachelierController::class, 'sendEmailForm'])->name('bacheliers.send_email');
