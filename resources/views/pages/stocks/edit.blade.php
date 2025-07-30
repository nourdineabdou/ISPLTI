<x-modal-header-body
    :title="__('stock.edit')">
    <div id="edit-stock-form">
        <form
            action="{{ route('stocks.update', $stock) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Nom"
                    name="nom"
                    required="required"
                    value="{{ $stock->nom }}"
                />
            </div>
            <div class="row">
                <x-forms.select
                    class="col-md-12"
                    label="Type de stock"
                    name="type"
                    :options="$types"
                    :value="$stock->type"
                />
            </div>
            <x-buttons.save
                container="edit-stock-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

