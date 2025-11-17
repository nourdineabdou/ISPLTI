<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurExperience;
use App\Models\Professeur;
use Illuminate\Support\Facades\File;
use App\Models\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // faire la partie index

        $professeur_user = User::firstOrCreate(['email' => 'safia@gmail.com'], [
            'name' => 'Safia amar',
            'email' => 'safia@gmail.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::firstOrCreate(['name' => 'Professeur']);
        $professeur_user->assignRole([$role->id]);
        $profosseur = Professeur::firstOrCreate(['user_id' => $professeur_user->id], [
            'user_id' => $professeur_user->id,
            'nom' => 'Safia',
            'prenom' => 'amar',
            'nni' => '1234567890',
            "email" => 'safia@gmail.com',
            "telephone" => '41419393',
            'specialite' => 'Linguistique',
            'image' => 'images_professeurs/default.png',
        ]);
        if (request()->ajax()) {
              return datatables()->of(ProfesseurExperience::query())
                  ->addColumn('action', function ($experience) {
                      $actions = [
                          [
                              'label' => 'Modifier expérience',
                              'onclick' => 'openInModal({ link: \'' . route('experiences.edit', $experience->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.experiences.index', [
              'actions' => [
                  [
                      'label' => __('experiences.create'),
                      'onclick' => 'openInModal({ link: \'' . route('experiences.create') . '\', size: \'lg\' })',
                      'permission' => true
                  ]
              ],
              'title' => __('experiences.list'),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //    'professeur_id',
    //     'job_title',
    //     'institution',
    //     'start_date',
    //     'end_date',
    //     'responsibilities',
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'institution' => 'required|string|max:8',
            "start_date" => "required|string|max:255",
            "end_date" => "required|string|max:255",
            "responsibilities" => "nullable|string",
        ]);
        $experience = new ProfesseurExperience();
        $experience->professeur_id = Professeur::where('user_id',auth()->user()->id)->first()->id;
        $experience->job_title = $validated['job_title'];
        $experience->institution = $validated['institution'];
        $experience->start_date = $validated['start_date'];
        $experience->end_date = $validated['end_date'];
        $experience->responsibilities = $validated['responsibilities'];
        $experience->save();
        return response()->json(
            [
                'message' => 'Experience créée avec succès',
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
        $experience = ProfesseurExperience::findOrFail($id);
        return view('pages.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $experience = ProfesseurExperience::findOrFail($id);
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'institution' => 'required|string|max:8',
            "start_date" => "required|string|max:255",
            "end_date" => "required|string|max:255",
            "responsibilities" => "nullable|string",
        ]);
        $experience->job_title = $validated['job_title'];
        $experience->institution = $validated['institution'];
        $experience->start_date = $validated['start_date'];
        $experience->end_date = $validated['end_date'];
        $experience->responsibilities = $validated['responsibilities'];
        $experience->save();

        return response()->json(
            [
                'message' => 'Experience mise à jour avec succès',
                'success' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $experience = ProfesseurExperience::findOrFail($id);
        $experience->delete();

        return response()->json(
            [
                'message' => 'Experience supprimée avec succès',
                'success' => true,
            ]
        );
    }


}
