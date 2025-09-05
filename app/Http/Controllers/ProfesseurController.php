<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;

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
                ->addColumn('user', function ($professeur) {
                    return $professeur?->user->nom;
                 })
                  ->addColumn('action', function ($professeur) {
                      $actions = [
                          [
                              'label' => 'Modifier professeur',
                              'onclick' => 'openInModal({ link: \'' . route('professeurs.edit', $professeur->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                          [
                              'label' => 'Supprimer professeur',
                              'onclick' => 'confirmDelete(\'' . route('professeurs.destroy', $professeur->id) . '\')',
                              'permission' =>true
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
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            "specialite" => "required|string|max:255"
        ]);

        $professeur = Professeur::create($validated);

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
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            "specialite" => "required|string|max:255"
        ]);

        $professeur->update($validated);

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
}
