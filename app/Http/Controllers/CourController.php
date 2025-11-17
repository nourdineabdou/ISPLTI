<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfProfe;
use App\Models\Professeur;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // faire la partie index
        if (request()->ajax()) {
              return datatables()->of(PdfProfe::query())
                  ->addColumn('action', function ($ours) {
                      $actions = [
                          [
                              'label' => 'Modifier cours',
                              'onclick' => 'openInModal({ link: \'' . route('mescours.edit', $ours->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.cours.index', [
              'actions' => [
                  [
                      'label' => __('cours.create'),
                      'onclick' => 'openInModal({ link: \'' . route('mescours.create') . '\', size: \'lg\' })',
                      'permission' => true
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
        return view('pages.cours.create');
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
            'chemain_pde' => 'file|string|max:255',
        ]);
        $cours = new PdfProfe();
        $cours->professeur_id = Professeur::where('user_id',auth()->user()->id)->first()->id;
        $cours->matiere_id = $validated['matiere_id'];
        $cours->specialite_id = $validated['specialite_id'];
        $cours->save();
         if ($request->hasFile('chemain_pde')) {
            //professeurs
            // faire le mouvement de fichier dans public/cvs_professeurs/
            File::move($request->file('chemain_pde')->getRealPath(), public_path('/cours' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension()));
            $cours->cv = 'cvs_professeurs/' . $cours->id . '.' . $request->file('chemain_pde')->getClientOriginalExtension();
            $cours->save();
        }
        return response()->json(
            [
                'message' => 'Cours créé avec succès',
                'success' => true,
            ]
        );
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
        return view('pages.cours.edit', compact('cours'));
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
