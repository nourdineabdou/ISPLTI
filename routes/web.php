<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//  Route::get('/', function () {
//     return redirect()->route('home');
// });


Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {

    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::get('', [App\Http\Controllers\HomeController::class, 'page'])->name('page')->middleware('middleware.sldown');

Route::group(['middleware' => ['auth'], 'prefix' => 'structures'], function () {
    Route::get('', function () {
        $baseFolder = resource_path('views/pages/structures'); // Replace with your folder path
        $folders = collect(File::directories($baseFolder))
            ->map(function ($folder) use ($baseFolder) {
                $folderName = basename($folder);
                return [
                    'slug' => $folderName,
                    'title' => str_replace('_', ' ', ucfirst($folderName)),
                    'creation_time' => filemtime($folder)
                ];
            })
            ->sortBy('creation_time')
            ->values();
        return view('pages.structures.index', compact('folders'));
    })->name('structures.index');
});
// Route::get('/language/switch/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Route::get('/language/switch/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
// Route::get('/translations', [LanguageController::class, 'getTranslations'])->name('translations');

// change language ar ou fr ou en
Route::get('/language/switch/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// routes des pages des site web
Route::group(['prefix' => 'pages'], function () {
    Route::get('actualite', [App\Http\Controllers\PageController::class, 'actualite'])->name('pages.actualite');
    Route::get('actualite/{actualite}', [App\Http\Controllers\PageController::class, 'actualiteShow'])->name('pages.actualite.show');
    Route::get('contact', [App\Http\Controllers\PageController::class, 'contact'])->name('pages.contact');
    Route::get('about', [App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
    // events
    Route::get('events', [App\Http\Controllers\PageController::class, 'events'])->name('pages.events');
    // events details
    Route::get('events/{id}', [App\Http\Controllers\PageController::class, 'eventDetails'])->name('pages.eventDetails');
    // vies estudiantine
    Route::get('vies-estudiantine', [App\Http\Controllers\PageController::class, 'viesEstudiantine'])->name('pages.viesEstudiantine');
    // about
    Route::get('about', [App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
    // page directeur
    Route::get('directeur/isptli', [App\Http\Controllers\PageController::class, 'directeur'])->name('pages.directeur');
});


// Route to export comptes from file
Route::get('comptes-from-file', [App\Http\Controllers\PageController::class, 'comptesFromFile'])->name('pages.comptesFromFile');


// formulaire inscription

    // login1 pour faire une inscription
    Route::get('login1', [App\Http\Controllers\InscriptionController::class, 'login1'])->name('inscriptions.login1');

    // login2 pour s'authentifier pour faire la réinscription
    Route::get('login2', [App\Http\Controllers\InscriptionController::class, 'login2'])->name('inscriptions.login2');

    // login2 pour s'authentifier pour faire la réinscription
    Route::post('login2', [App\Http\Controllers\InscriptionController::class, 'login_etudiant'])->name('inscriptions.login_etudiant');

    // login1 pour faire une inscription
    Route::post('login1', [App\Http\Controllers\InscriptionController::class, 'login_bachelier'])->name('inscriptions.login_bachelier');

    Route::group(['prefix' => 'inscriptions'], function () {
        Route::get('', [App\Http\Controllers\InscriptionController::class, 'inscriptions'])->name('inscriptions.index');
        Route::get('rescriptions', [App\Http\Controllers\InscriptionController::class, 'rescription'])->name('inscriptions.rescription');
        // post inscriptions d'un bachelier
        Route::post('/{bachelierID}', [App\Http\Controllers\InscriptionController::class, 'store'])->name('inscriptions.store');
        // post rescriptions etudiant
        Route::post('rescriptions/{etudiantID}', [App\Http\Controllers\InscriptionController::class, 'update'])->name('inscriptions.update');
    });

// candidature en ligne (master) - tunnel public, sans compte
Route::group(['prefix' => 'candidature'], function () {
    Route::get('', [App\Http\Controllers\CandidatureController::class, 'intro'])->name('candidature.intro');
    Route::get('etape1', [App\Http\Controllers\CandidatureController::class, 'etape1'])->name('candidature.etape1');
    Route::post('etape1', [App\Http\Controllers\CandidatureController::class, 'storeEtape1'])->name('candidature.etape1.store');
    Route::get('reprendre/{token}', [App\Http\Controllers\CandidatureController::class, 'reprendre'])->name('candidature.reprendre');
    Route::post('renvoyer/{token}', [App\Http\Controllers\CandidatureController::class, 'renvoyerLien'])->middleware('throttle:3,1')->name('candidature.renvoyer');
    Route::get('mot-de-passe', [App\Http\Controllers\CandidatureController::class, 'definirMotDePasse'])->name('candidature.definirMotDePasse');
    Route::post('mot-de-passe', [App\Http\Controllers\CandidatureController::class, 'definirMotDePasseStore'])->name('candidature.definirMotDePasse.store');
    Route::get('connexion', [App\Http\Controllers\CandidatureController::class, 'connexion'])->name('candidature.connexion');
    Route::post('connexion', [App\Http\Controllers\CandidatureController::class, 'connexionStore'])->middleware('throttle:6,1')->name('candidature.connexion.store');
    Route::get('deconnexion', [App\Http\Controllers\CandidatureController::class, 'deconnexion'])->name('candidature.deconnexion');
    Route::get('espace', [App\Http\Controllers\CandidatureController::class, 'espace'])->name('candidature.espace');
    Route::post('espace/photo', [App\Http\Controllers\CandidatureController::class, 'mettreAJourPhoto'])->name('candidature.photo.update');
    Route::get('suite', [App\Http\Controllers\CandidatureController::class, 'suite'])->name('candidature.suite');
    Route::post('suite', [App\Http\Controllers\CandidatureController::class, 'storeSuite'])->name('candidature.suite.store');
    Route::post('suite/etape1', [App\Http\Controllers\CandidatureController::class, 'sauvegarderEtape1'])->name('candidature.suite.etape1');
    Route::post('suite/etape2', [App\Http\Controllers\CandidatureController::class, 'sauvegarderEtape2'])->name('candidature.suite.etape2');
    Route::post('suite/etape3', [App\Http\Controllers\CandidatureController::class, 'sauvegarderEtape3'])->name('candidature.suite.etape3');
    Route::get('image/{id}', [App\Http\Controllers\CandidatureController::class, 'image'])->name('candidature.image');
});

// candidatures - back-office admin
Route::group(['middleware' => ['auth'], 'prefix' => 'candidatures'], function () {
    Route::get('', [App\Http\Controllers\CandidatureAdminController::class, 'index'])->name('candidatures.index');
    Route::get('{id}', [App\Http\Controllers\CandidatureAdminController::class, 'show'])->name('candidatures.show');
    Route::get('{id}/zip', [App\Http\Controllers\CandidatureAdminController::class, 'telechargerZip'])->name('candidatures.zip');
    Route::get('{id}/document/{documentId}', [App\Http\Controllers\CandidatureAdminController::class, 'document'])->name('candidatures.document');
    Route::get('{id}/fichier', [App\Http\Controllers\CandidatureAdminController::class, 'fichier'])->name('candidatures.fichier');
    Route::get('{id}/statut/{statut}', [App\Http\Controllers\CandidatureAdminController::class, 'changerStatut'])->name('candidatures.statut');
    Route::post('{id}/decision', [App\Http\Controllers\CandidatureAdminController::class, 'decision'])->name('candidatures.decision');
    Route::post('{id}/renvoyer-email', [App\Http\Controllers\CandidatureAdminController::class, 'renvoyerEmail'])->middleware('throttle:3,1')->name('candidatures.renvoyerEmail');
});
