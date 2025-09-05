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

Route::get('/', function () {
    return redirect()->route('home');
});


Route::get('test', [App\Http\Controllers\MealController::class, 'test']);

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::get('', [App\Http\Controllers\HomeController::class, 'page'])->name('page');

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
    //
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
