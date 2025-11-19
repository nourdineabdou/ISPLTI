<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurEducation;
use App\Models\Professeur;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // faire la partie index
        if (request()->ajax()) {
              return datatables()->of(ProfesseurEducation::query())
                  ->addColumn('action', function ($formation) {
                      $actions = [
                          [
                              'label' => 'Modifier formation',
                              'onclick' => 'openInModal({ link: \'' . route('formations.edit', $formation->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.formations.index', [
              'actions' => [
                  [
                      'label' => __('formations.create'),
                      'onclick' => 'openInModal({ link: \'' . route('formations.create') . '\', size: \'lg\' })',
                      'permission' => true
                  ]
              ],
              'title' => __('formations.list'),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.formations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //     'professeur_id',
        //     'degree',
        //     'institution',
        //     'start_year',
        //     'end_year',
        //     'description',
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:8',
            "start_year" => "required|string|max:255",
            "end_year" => "required|string|max:255",
            "description" => "nullable|string",
        ]);
        $formation = new ProfesseurEducation();
        $formation->professeur_id = Professeur::where('user_id',auth()->user()->id)->first()->id;
        $formation->degree = $validated['degree'];
        $formation->institution = $validated['institution'];
        // recupere l'année actuelle $validated['end_year']


        $formation->start_year = $validated['start_year'];
        $formation->end_year = $validated['end_year'];
        $formation->description = $validated['description'];
        $formation->save();
        return response()->json(
            [
                'message' => 'Formation créée avec succès',
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
        $formation = ProfesseurEducation::findOrFail($id);
        return view('pages.formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formation = ProfesseurEducation::findOrFail($id);
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:8',
            "start_year" => "required|string|max:255",
            "end_year" => "required|string|max:255",
            "description" => "nullable|string",
        ]);
        $formation->degree = $validated['degree'];
        $formation->institution = $validated['institution'];
        $formation->start_year = $validated['start_year'];
        $formation->end_year = $validated['end_year'];
        $formation->description = $validated['description'];
        $formation->save();

        return response()->json(
            [
                'message' => 'Formation mise à jour avec succès',
                'success' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formation = ProfesseurEducation::findOrFail($id);
        $formation->delete();

        return response()->json(
            [
                'message' => 'Formation supprimée avec succès',
                'success' => true,
            ]
        );
    }


}
