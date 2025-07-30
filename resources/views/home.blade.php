<x-layouts.main
    :title="__('Dashboard Restaurant')"
>
   <div class="row">
       <div class="col-12">
           <div class="row">
             @foreach(\App\Models\Caisse::where('type', 'restaurant')->get() as $caisse)
                  @foreach ($caisse->temporaires  as $temporaire)
                    <div class="col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="text-muted">
                                                    {{ $caisse->nom }} {{ $temporaire->libelle }}
                                                </h6>
                                                {{  $temporaire->user ?  $temporaire->user->name : '' }}
                                            </div>
                                            <div class="d-flex justify-content-between">
                                            <h3>{{ \App\Models\TemporairesOrder::where('temporaire_id' ,$temporaire->id )->whereDate('created_at', \Carbon\Carbon::today())->sum('montant') }} MRU</h3>
                                            {{ \Carbon\Carbon::now() }}
                                            </div>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-trophy success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                @foreach(\App\Models\PaymentMethod::all() as $index => $method)
                                                    <tr>
                                                        <th scope="row">{{ $method->name }}</th>
                                                        <td class="text-right">{{ \App\Models\TemporairesOrder::whereDate('created_at', \Carbon\Carbon::today())->whereIn('order_id' , $temporaire->orders->where("payment_method_id" , $method->id)->pluck('id'))->sum('montant')     }} MRU</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
             @endforeach
           </div>
       </div>
   </div>
   <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('order.top_meals') }}
                    </h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                @foreach($topMeals as $meal)
                                    <tr>
                                        <th scope="row">{{ $meal->name }}</th>
                                        <td class="text-right">{{ $meal->total }}</td>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Nb de palat vendus</h6>
                                        <h3>{{ \App\Models\OrderDetail::where("created_at" , ">="  ,$this_day )->sum('quantity') }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-trophy success font-large-2 float-right"></i>
                                    </div>
                                    {{ \Carbon\Carbon::now() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Nb des commandes</h6>
                                        <h3>
                                            {{ \App\Models\Order::where("status" , 'completed' )->where('created_at' ,'>=' ,$this_day)->count() }}
                                        </h3>
                                    </div>
                                    <div class="align-self-center">

                                        <i class="icon-call-in danger font-large-2 float-right"></i>
                                    </div>
                                    {{ \Carbon\Carbon::now() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Nb Com Impeyés</h6>
                                        <h3>
                                            {{ \App\Models\Order::where("status" , "<>" ,  'completed' )->where('created_at' ,'>=' ,$this_day)->count() }}
                                        </h3>
                                    </div>
                                    <div class="align-self-center">

                                        <i class="icon-call-in danger font-large-2 float-right"></i>
                                    </div>
                                    {{ \Carbon\Carbon::now() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Nb Com annuler</h6>
                                        <h3>
                                            {{ \App\Models\Order::where("status"  ,  'cancel' )->where('created_at' ,'>=' ,$this_day)->count() }}
                                        </h3>
                                    </div>
                                    <div class="align-self-center">

                                        <i class="icon-call-in danger font-large-2 float-right"></i>
                                    </div>
                                    {{ \Carbon\Carbon::now() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
        <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>

        <script src="{{ asset('app-assets/js/scripts/pages/dashboard-sales.js') }}"></script>
    @endpush

</x-layouts.main>
