<x-layouts.main
    :title="$title"
   :actions="$actions">
<div class="card datatable-container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <x-forms.select
                    class="col"
                    label="Produits"
                    :options="$produits"
                    data-filter="produit"
                />
                <x-forms.input
                    class="col"
                    name="start_date"
                    :label="__('order.start_date')"
                    type="date"
                    data-filter="start_date"
                    {{-- value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  --}}
                />
                <x-forms.input
                    class="col"
                    name="end_date"
                    :label="__('order.end_date')"
                    type="date"
                    value="{{ $date }}"
                    data-filter="end_date"
                />
            </div>

        </div>
        <div class="card-body">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('stocks.systeme') }}"
                    data-column='produit,consome,restant'
                >
                    <thead>
                    <tr>
                        <td>{{ __("Ingrédient") }}</td>
                        <td>{{ __("Consommation") }}</td>
                        <td>{{ __("Stock cuisine") }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</x-layouts.main>
