<x-layouts.main
    :title="$title"
    :actions="$actions" >
<div class="card datatable-container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <x-forms.select
                    class="col"
                    label="Stock"
                    :options="$stocks"
                    label-field="nom"
                    data-filter="stock"
                    select-class="select2"
                />
                <x-forms.select
                    class="col-md-6"
                    label="Produits"
                    :options="$produits"
                    data-filter="produit"
                    select-class="select2"
                />
            </div>
        </div>
        <div class="card-body">
            <table
                class="table table-striped table-bordered w-100"
                data-url="{{ route('stocks.index') }}"
                data-column='nom,produit,emballage,mesure_total,nb_prod,nb_prod_total,qte,action'>
                <thead>
                <tr>
                    <td>{{ __("stock.stock") }}</td>
                    <td>{{ __("stock.produit") }}</td>
                    <td>{{ __("commande.emballage") }}</td>
                    <td>{{ __("Mesure/taille total") }}</td>
                    <td>{{ __("commande.nb_prod_embl") }}</td>
                    <td>{{ __("commande.nb_prod_total") }}</td>
                    <td>{{ __("stock.qte") }}</td>
                    <td>{{ __("system.action") }}</td>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
 </div>
</x-layouts.main>
