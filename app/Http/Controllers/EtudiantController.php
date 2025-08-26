<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index
        if (request()->ajax()) {
            return datatables()->of(Etudiant::query())
                ->addColumn('action', function ($etudiant) {
                    $actions = [
                        [
                            'label' => 'Modifier étudiant',
                            'onclick' => 'openInModal({ link: \'' . route('etudiants.edit', $etudiant->id) . '\', size: \'lg\' })',
                            'permission' => true
                        ],
                        [
                            'label' => 'Supprimer étudiant',
                            'onclick' => 'confirmDelete(\'' . route('etudiants.destroy', $etudiant->id) . '\')',
                            'permission' => true
                        ]
                    ];
                    return view('components.buttons.action', compact('actions'));

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.etudiants.index', [

            'actions' => [
                [
                    'label' => __('etudiants.create'),
                    'onclick' => 'openInModal({ link: "' . route('etudiants.create') . '" })',
                    'permission' => true,
                ]
            ],
            'title' => "Liste des étudiants",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for creating a new resource.
        return view('pages.etudiants.create', [
            'title' => __('etudiants.create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data.
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu_naissance' => 'required|string|max:255',
        ]);

        // Create a new Etudiant instance and fill it with the request data.
        $etudiant = new Etudiant();
        $etudiant->nom = $request->input('nom');
        $etudiant->lieu_naissance = $request->input('lieu_naissance');
        $etudiant->save();

        // Redirect or return a response json.
        return response()->json([
            'success' => true,
            'message' => 'Etudiant créé avec succès.'
        ]);
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
    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('pages.etudiants.edit', [
            'title' => __('etudiants.edit'),
            'etudiant' => $etudiant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data.
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu_naissance' => 'required|string|max:255',
        ]);

        // Find the Etudiant instance and update it with the request data.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->nom = $request->input('nom');
        $etudiant->lieu_naissance = $request->input('lieu_naissance');
        $etudiant->save();

        // Redirect or return a response.
        return response()->json([
            'success' => true,
            'message' => 'Etudiant mis à jour avec succès.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Etudiant instance and delete it.
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        // Redirect or return a response.
         return response()->json([
              'success' => true,
              'message' => 'Etudiant supprimé avec succès.'
          ]);
    }
}
