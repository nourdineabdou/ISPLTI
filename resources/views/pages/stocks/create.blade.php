<x-modal-header-body
    :title="__('stock.create')"
>
    <div id="create-stock-form">
        <form
            action="{{ route('stocks.store') }}"
            method="POST"
            id="create-stock-form"
            class="form"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Nom"
                    name="nom"
                    required="required"
                    value="{{ old('name') }}"
                />
            </div>
            <div class="row">
                <x-forms.select
                    class="col-md-12"
                    label="Type de stock"
                    name="type"
                    :options="$types"
                />
            </div>
            <x-buttons.save
                container="create-stock-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
