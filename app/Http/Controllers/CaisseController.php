<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\Caisse;
use App\Models\Temporaire;
use App\Models\Horaire;
use App\Models\Order;
use App\Models\TemporairesOrder;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaisseController extends Controller
{
      // index
      public function index()
      {
          if (request()->ajax()) {
              return datatables()->of(Caisse::query())
                ->addColumn('user', function ($caisse) {
                    return $caisse->user->name;
                 })
                  ->addColumn('action', function ($caisse) {
                      $actions = [
                          [
                              'label' => 'Modifier caisse',
                              'onclick' => 'openInModal({ link: \'' . route('caisses.edit', $caisse->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                          [
                            'label' => 'Habilitation caisse',
                            'onclick' => 'openInModal({ link: \'' . route('caisses.edit_temporaire', $caisse->id) . '\', size: \'lg\' })',
                            'permission' => true
                        ],
                          [
                              'label' => 'Supprimer caisse',
                              'onclick' => 'confirmDelete(\'' . route('caisses.destroy', $caisse->id) . '\')',
                              'permission' =>true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }

          return view('pages.caisses.index', [
              'actions' => [
                  [
                      'label' => __('caisses.create'),
                      'onclick' => 'openInModal({ link: \'' . route('caisses.create') . '\', size: \'lg\' })',
                      'permission' => 'product-create'
                  ]
              ],
              'title' => __('caisses.list'),
          ]);
      }


      // horaire index
      public function horaires()
      {
          if (request()->ajax()) {
              return datatables()->of(Horaire::query())
                ->addColumn('caissier', function ($horaire) {
                    return $horaire->temporaire->user->name;
                 })
                ->addColumn('nom', function ($horaire) {
                    return $horaire->temporaire->caisse->nom;
                })// horaire
                ->addColumn('horaire', function ($horaire) {
                    return $horaire->temporaire->libelle;
                })
                ->editColumn('etat', function ($horaire) {
                    switch ($horaire->etat) {
                        case "en attente":
                            return '<span class="badge badge-warning">En attente</span>';
                        case "validé":
                            return '<span class="badge badge-success">Validé</span>';
                        default:
                            return '<span class="badge badge-danger">Exceédant</span>';
                    }
                })
                 //montant total
                 ->addColumn('montant', function ($horaire) {
                    $total = 0;
                       // recupere les montant des horaires
                    $temporaire_orders = TemporairesOrder::where('horaire_id', $horaire->id)->get();
                    foreach ($temporaire_orders as $temporaire) {
                        $total += $temporaire->montant;
                    }

                        return number_format($total, 2, ',', ' ') . ' MRU';
                    })
                    // nombre de commande
                    ->addColumn('nombre', function ($horaire) {
                        // recupere les nombre de commande des horaires
                        $temporaire_orders = TemporairesOrder::where('horaire_id', $horaire->id)->get();
                        return $temporaire_orders->count();
                    })

                  ->addColumn('action', function ($horaire) {
                      $actions = [
                          [
                            'label' => 'valider horaire',
                            'onclick' => 'confirmDelete(\'' . route('caisses.valider_horaire', $horaire->id) . '\')',
                            'permission' =>true
                          ],
                          //vusialiser le detail de l'horaire
                          [
                              'label' => 'Visualiser horaire',
                              'onclick' => 'openInModal({ link: \'' . route('caisses.edit_temporaire', $horaire->temporaire->caisse->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                          // declarer un execédant
                          [
                              'label' => 'Declarer excédant',
                              'onclick' => 'openInModal({ link: \'' . route('caisses.edit_temporaire', $horaire->temporaire->caisse->id) . '\', size: \'lg\' })',
                              'permission' => true
                          ],
                      ];
                      return view('components.buttons.action', compact('actions'));
                  })
                  ->rawColumns(['action', 'etat'])
                  ->make(true);
          }

          return view('pages.caisses.horaire', [
              'title' => __('caisses.liste_horaires'),

          ]);
      }

      //valider horaire
      public function active_horaire(Horaire $horaire)
      {
          $horaire->update([
              'etat' => "validé",
          ]);
          return response()->json([
              'success' => true,
              'message' => 'Horaire valider avec succès.'
          ]);
      }

      // show
      public function show(Caisse $caisse)
      {
          return view('pages.caisses.show', [
              'product' => $caisse,
              'breadcrumbs' => [
                  'Dashboard' => route('home'),
                  'Products' => route('caisses.index'),
                  $caisse->name => null
              ],
              'actions' => [
                  [
                      'label' => 'Modifier caisse',
                      'onclick' => 'openInModal({ link: \'' . route('caisses.edit', $caisse->id) . '\', size: \'lg\' })',
                      'permission' => 'product-create'
                  ],
                  [
                      'label' => 'Supprimer caisse',
                      'onclick' => 'confirmDelete(\'' . route('caisses.destroy', $caisse->id) . '\')',
                      'permission' => 'product-delete'
                  ]
              ]
          ]);
      }

      // create
      public function create()
      {
            $users = User::all();
          return view('pages.caisses.create' , compact('users'));
      }

      // store
      public function store(Request $request)
      {

          $this->extracted($request);

          try {
              DB::beginTransaction();
              $caisse = Caisse::create([
                  'nom' => $request->nom,
                    'type' => $request->type,
              ]);
              Temporaire::create([
                  'caisse_id' => $caisse->id,
                  'libelle' => "journée",
              ]);
              Temporaire::create([
                  'caisse_id' => $caisse->id,
                  'libelle' => "soiree",
              ]);
              DB::commit();
              return response()->json([
                  'success' => true,
                  'message' => 'Caisse creer  avec succès.'
              ]);
          } catch (\Exception $e) {
                DB::rollBack();
                \Log::error($e);
              return response()->json([
                  'success' => false,
                  'message' => 'Erreur lors de la création de la caisse. '.$e->getMessage()
              ], 500);
          }
      }
      public function testOrder(){
        $order = Order::find(3);
        foreach ($order->order_items as $key => $value) {
            if($value->meal && $value->meal->meal_ingredient)
                $order->Refrech_Stock($value->meal->meal_ingredient,$value->quantity);
        }
        return "les stock refrech";
      }
      // edit
      public function edit(Caisse $caisse)
      {
            $users = User::all();

          return view('pages.caisses.edit' , compact('users','caisse'));
      }
      public function edit_temporaire(Caisse $caisse)
      {
        $users = User::all();
        $soire_user_id = Temporaire::where('caisse_id', $caisse->id)->where('libelle' , "soiree")->first()->user_id;
        $journe_user_id = Temporaire::where('caisse_id', $caisse->id)->where('libelle' , "journée")->first()->user_id;

        return view('pages.caisses.temporaire' , compact('users','caisse' , 'soire_user_id' , 'journe_user_id'));
      }
      // update temporaire
      public function update_temporaire(Request $request, Caisse $caisse)
      {
          $this->validate($request, [
              'journee' => 'required',
              'soiree' => 'required',
              'user_journee' => 'required',
              'user_soiree' => 'required',
          ]);
          try {
              DB::beginTransaction();
              Temporaire::where('caisse_id', $caisse->id)->where('libelle' , "journée")
              ->update([
                  'user_id' => $request->user_journee,
              ]);
              Temporaire::where('caisse_id', $caisse->id)->where('libelle' , "soiree")
              ->update([
                  'user_id' => $request->user_soiree,
              ]);
              DB::commit();
              return response()->json([
                  'success' => true,
                  'message' => 'Le temporaire pour '.$caisse->nom.' est modifier avec succès .'
              ]);
          } catch (\Exception $e) {
                DB::rollBack();
              return response()->json([
                  'success' => false,
                  'message' => 'Erreur lors de la modification du temporaire. '.$e->getMessage()
              ]);
          }
      }
      // update
      public function update(Request $request, Caisse $caisse)
      {
        ///dd($request->all());
          $this->extracted($request);
          $caisse->update([
            'nom' => $request->nom,
            'type' => $request->type,
          ]);
          return response()->json([
            'success' => true,
            'message' => 'Caisse mis à jour avec succès.'
          ]);
      }

      // destroy
      public function destroy(Caisse $caisse)
      {
          $caisse->delete();
          return response()->json([
              'success' => true,
              'message' => 'Caisse supprimé avec succès.'
          ]);
      }

      /**
       * @param Request $request
       * @return void
       */
      public function extracted(Request $request): void
      {
          $request->validate([
              //'user' => 'required',
              'nom' => 'required',
          ]);
      }
}
