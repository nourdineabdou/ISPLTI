<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfProfe;
use App\Models\Professeur;
// matiere
// specialite
// InscriptionPdg
use App\Models\Matiere;
use App\Models\Specialite;
use App\Models\InscriptionPdg;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // activer un cours $id
    public function activer($id)
    {
        $cours = PdfProfe::findOrFail($id);
        $cours->active = 1;
        $cours->save();
        // response  response()->json(

        return response()->json(
            [
                'message' => 'Cours activé avec succès',
                'success' => true,
            ]
        );
    }

    public function index( $etudiantId = null)
    {
        // faire la partie index
        if (request()->ajax()) {
               if($etudiantId)
               $cours=  PdfProfe::whereIn('matiere_id' , InscriptionPdg::where('etudiant_id' , $etudiantId)->pluck('matiere_id'))
            ->where('active', 1);
               else
                $cours= PdfProfe::query();
            if(auth()->user()->hasRole('Admin'))
                $cours= PdfProfe::where('active', 0)->orWhereNull('active');
              return datatables()->of($cours)
                  ->addColumn('action', function ($cour) {

                        // telecharger le cours si $ours->chemain_pde existe
                        // si le utilisateur est admin il peux activer le cours

                    if ($cour->chemain_pde ) {
                      $actions = [
                          [
                              'label' => 'Modifier cours',
                              'onclick' => 'openInModal({ link: \'' . route('mescours.edit', $cour->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                            [
                                'label' => 'Télécharger cours',
                                'onclick' => '(window.location.href = \'' . route('mescours.download', $cour->id) . '\')',
                                'permission' => true
                            ],
                            [
                                'label' => 'Activer cours',
                                'onclick' => 'confirmAction({ title: \'Confirmer l activation\', text: \'Voulez-vous vraiment activer ce cours ?\', confirmButtonText: \'Oui, activer !\', url: \'' . route('mescours.activer', $cour->id) . '\', method: \'GET\' })',
                                'permission' => auth()->user()->hasRole('Admin') ? true : false
                            ]
                      ];
                    } else {
                        $actions = [
                            [
                                'label' => 'Modifier cours',
                                'onclick' => 'openInModal({ link: \'' . route('mescours.edit', $cour->id) . '\', size: \'lg\' })',
                                'permission' => true
                            ],
                                [
                                    'label' => 'Supprimer cours',
                                    'onclick' =>'confirmAction({ title: \'Confirmer la suppression\', text: \'Voulez-vous vraiment supprimer ce cours ?\', confirmButtonText: \'Oui, supprimer !\', url: \'' . route('mescours.destroy', $cour->id) . '\', method: \'DELETE\' })',
                                    'permission' => true
                                ],

                                [
                                'label' => 'Activer cours',
                                'onclick' => 'confirmAction({ title: \'Confirmer l activation\', text: \'Voulez-vous vraiment activer ce cours ?\', confirmButtonText: \'Oui, activer !\', url: \'' . route('mescours.activer', $cour->id) . '\', method: \'GET\' })',
                                'permission' => auth()->user()->hasRole('Admin') ? true : false
                                ]
                        ];
                        }
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->editColumn('matiere_id', function ($cours) {
                      return $cours->matiere ? $cours->matiere->lib_element_fr : 'N/A';
                  })
                  ->editColumn('specialite_id', function ($cours) {
                      return $cours->specialite ? $cours->specialite->lib_annee_diplome_fr : 'N/A';
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.cours.index', [
              'actions' => [
                  [
                      'label' => __('cours.create'),
                      'onclick' => 'openInModal({ link: \'' . route('mescours.create') . '\', size: \'lg\' })',
                      'permission' => auth()->user()->hasRole('Professeur') ? true : false,
                  ]
              ],
              'title' => __('cours.list'),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.cours.create', [
            'matieres' => Matiere::all(),
            'specialites' => Specialite::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // 'matiere_id',
        // 'specialite_id',
        // 'chemain_pde',
        $validated = $request->validate([
            'matiere_id' => 'required|string|max:255',
            'specialite_id' => 'required|string|max:255',
            'chemain_pde' => 'required|file',
        ]);
        $cours = new PdfProfe();
        $cours->professeur_id = Professeur::where('user_id',auth()->user()->id)->first()->id;
        $cours->matiere_id = $validated['matiere_id'];
        $cours->specialite_id = $validated['specialite_id'];
        $cours->save();
         if ($request->hasFile('chemain_pde')) {
            //professeurs
            // faire le mouvement de fichier dans public/cvs_professeurs/
            File::move($request->file('chemain_pde')->getRealPath(), public_path('/cours_professeurs/' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension()));
            $cours->chemain_pde = 'cours_professeurs/' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension();
            $cours->save();
        }
        return response()->json(
            [
                'message' => 'Cours créé avec succès',
                'success' => true,
            ]
        );
    }

    // telecharger le cours
    public function download($id)
    {
        $cours = PdfProfe::findOrFail($id);
        $filePath = public_path($cours->chemain_pde);
        return response()->download($filePath);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $cours = PdfProfe::findOrFail($id);
        return view('pages.cours.edit', [
            'cours' => $cours,
            'matieres' => Matiere::all(),
            'specialites' => Specialite::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cours = PdfProfe::findOrFail($id);
        $validated = $request->validate([
            'matiere_id' => 'required|string|max:255',
            'specialite_id' => 'required|string|max:255',
        ]);
        $cours->matiere_id = $validated['matiere_id'];
        $cours->specialite_id = $validated['specialite_id'];
        if ($request->hasFile('chemain_pde')) {
            //professeurs
            // faire le mouvement de fichier dans public/cvs_professeurs/
            File::move($request->file('chemain_pde')->getRealPath(), public_path('/cours' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension()));
            $cours->cv = 'cvs_professeurs/' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension();
        }
        $cours->save();
        return response()->json(
            [
                'message' => 'Cours mis à jour avec succès',
                'success' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cours = PdfProfe::findOrFail($id);
        $cours->delete();

        return response()->json(
            [
                'message' => 'Cours supprimé avec succès',
                'success' => true,
            ]
        );
    }


}
