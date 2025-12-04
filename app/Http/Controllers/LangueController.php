<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurLanguage;
use App\Models\Professeur;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class LangueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // faire la partie index
        if (request()->ajax()) {
              return datatables()->of(ProfesseurLanguage::query()->where('professeur_id', Professeur::where('user_id',auth()->user()->id)->first()->id))
                  ->addColumn('action', function ($language) {
                      $actions = [
                          [
                              'label' => 'Modifier langue',
                              'onclick' => 'openInModal({ link: \'' . route('languages.edit', $language->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.languages.index', [
              'actions' => [
                  [
                      'label' => __('languages.create'),
                      'onclick' => 'openInModal({ link: \'' . route('languages.create') . '\', size: \'lg\' })',
                      'permission' => true
                  ]
              ],
              'title' => __('languages.list'),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // 'professeur_id',
        // 'language',
        // 'niveau',
        $validated = $request->validate([
            'language' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);
        $language = new ProfesseurLanguage();
        $language->professeur_id = Professeur::where('user_id',auth()->user()->id)->first()->id;
        $language->language = $validated['language'];
        $language->niveau = $validated['niveau'];
        $language->save();
        return response()->json(
            [
                'message' => 'Langue créée avec succès',
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
        $language = ProfesseurLanguage::findOrFail($id);
        return view('pages.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $language = ProfesseurLanguage::findOrFail($id);
        $validated = $request->validate([
            'language' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);
        $language->language = $validated['language'];
        $language->niveau = $validated['niveau'];
        $language->save();
        return response()->json(
            [
                'message' => 'Langue mise à jour avec succès',
                'success' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $language = ProfesseurLanguage::findOrFail($id);
        $language->delete();

        return response()->json(
            [
                'message' => 'Langue supprimée avec succès',
                'success' => true,
            ]
        );
    }


}
