<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;
//EmploisTempsProfesseur
use App\Models\EmploisTempsProfesseur;
// AnneeUniversitaire
use App\Models\AnneeUniversitaire;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // faire la partie index
        if (request()->ajax()) {
              return datatables()->of(Professeur::query())
                  ->addColumn('action', function ($professeur) {
                      $actions = [
                          [
                              'label' => 'Modifier professeur',
                              'onclick' => 'openInModal({ link: \'' . route('professeurs.edit', $professeur->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.professeurs.index', [
              'actions' => [
                  [
                      'label' => __('professeurs.create'),
                      'onclick' => 'openInModal({ link: \'' . route('professeurs.create') . '\', size: \'lg\' })',
                      'permission' => true
                  ]
              ],
              'title' => __('professeurs.list'),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.professeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:8',
            "specialite" => "required|string|max:255",
            "nni" => "required|string|max:10|unique:professeurs,nni",
            "cv" => "nullable|file|mimes:pdf|max:2048",
            "image" => "nullable|file|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $professeur = new Professeur();
        $professeur->nom = $validated['nom'];
        $professeur->telephone = $validated['telephone'];
        $professeur->specialite = $validated['specialite'];
        $professeur->nni = $validated['nni'];
        $professeur->prenom = $request->prenom;
        $professeur->email = $request->email;
        $professeur->save();
        if ($request->hasFile('cv')) {
            //professeurs
            // faire le mouvement de fichier dans public/cvs_professeurs/
            File::move($request->file('cv')->getRealPath(), public_path('cvs_professeurs/' . $professeur->id . '.' . $request->file('cv')->getClientOriginalExtension()));
            $professeur->cv = 'cvs_professeurs/' . $professeur->id . '.' . $request->file('cv')->getClientOriginalExtension();
        }

        if ($request->hasFile('image')) {
            // faire le mouvement de fichier dans public/images_professeurs/
            File::move($request->file('image')->getRealPath(), public_path('images_professeurs/' . $professeur->id . '.' . $request->file('image')->getClientOriginalExtension()));
            $professeur->image = 'images_professeurs/' . $professeur->id . '.' . $request->file('image')->getClientOriginalExtension();
        }else{
            $professeur->image = 'images_professeurs/default.png';
        }

         // créer user professeur
        $user = new User();
        $user->name = $professeur->nom;
        $user->email = $professeur->email;
        $user->password = Hash::make('password');
        $user->save();
        // assigner le role professeur
        $role = Role::where('name', 'Professeur')->first();
        $professeur->user_id = $user->id;
        $professeur->save();
        $user->assignRole($role);
        // return success response
        return response()->json(
            [
                'message' => 'Professeur created successfully',
                'success' => true,
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $professeur = Professeur::findOrFail($id);
        return view('pages.professeurs.edit', compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $professeur = Professeur::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:8',
            "specialite" => "required|string|max:255",
            "nni" => "required|string|max:10|unique:professeurs,nni," . $professeur->id,
            "cv" => "nullable|file|mimes:pdf|max:2048",
            "image" => "nullable|file|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $professeur->nom = $validated['nom'];
        $professeur->telephone = $validated['telephone'];
        $professeur->specialite = $validated['specialite'];
        $professeur->nni = $validated['nni'];
        $professeur->prenom = $request->prenom;
        $professeur->email = $request->email;
        if ($request->hasFile('cv')) {
            // faire le mouvement de fichier dans public/cvs_professeurs/
            File::move($request->file('cv')->getRealPath(), public_path('cvs_professeurs/' . $professeur->id . '.' . $request->file('cv')->getClientOriginalExtension()));
            $professeur->cv = 'cvs_professeurs/' . $professeur->id . '.' . $request->file('cv')->getClientOriginalExtension();
        }
        if ($request->hasFile('image')) {
            // faire le mouvement de fichier dans public/images_professeurs/
            File::move($request->file('image')->getRealPath(), public_path('images_professeurs/' . $professeur->id . '.' . $request->file('image')->getClientOriginalExtension()));
            $professeur->image = 'images_professeurs/' . $professeur->id . '.' . $request->file('image')->getClientOriginalExtension();
        }elseif($professeur->image !== 'images_professeurs/default.png' ){
            // ne rien faire
        }else{
            $professeur->image = 'images_professeurs/default.png';
        }
        $professeur->save();

        return response()->json(
            [
                'message' => 'Professeur mise à jour avec succès',
                'success' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $professeur = Professeur::findOrFail($id);
        $professeur->delete();

        return response()->json(
            [
                'message' => 'Professeur supprimé avec succès',
                'success' => true,
            ]
        );
    }

    // form blade pour fixe un emploi du temps pour un professeur
    public function emploiDuTemps()
    {
        return view('pages.professeurs.emploi_du_temps',['professeurs' => Professeur::all(),
            'annees' => AnneeUniversitaire::all(),
            "title" => "Emploi du temps pour un professeur"
        ]);
    }

    // post emploi du temps pour un professeur
    public function storeEmploiDuTemps(Request $request)
    {

        $validated = $request->validate([
            'professeur_id' => 'required|string|max:255',
            'annee_id' => 'required|string|max:20',
            'emplacement' => 'required',
        ]);


        $emloisTemps = new EmploisTempsProfesseur;
        $emloisTemps->professeur_id = $validated['professeur_id'];
        $emloisTemps->annee_id = $validated['annee_id'];
        // emplacement photo emplois dans public/emplois/
        $emloisTemps->save();
        if ($request->hasFile('emplacement')) {
            $file = $request->file('emplacement');
            // le path de l'emploi du temps doit être stocké dans public/emplois/ et le fichier porte le id EmploisTempsProfesseur
            $emloisTemps->emplacement = 'emplois/' . $emloisTemps->id . '.' . $file->getClientOriginalExtension();

            // movement de fichier d'emplois dans public/emplois/
            // utilise FILE class
            File::move($file->getRealPath(), public_path($emloisTemps->emplacement));
        }

        $emloisTemps->save();

        return response()->json(
            [
                'message' => 'Emploi du temps créé avec succès',
                'success' => true,
            ]
        );
    }

}
