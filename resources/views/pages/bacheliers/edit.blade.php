<x-modal-header-body
    :title="__('Motif de rejet de :name', ['name' => $bachelier->nom_fr])"
>
    <div id="edit-bachelier-form">
        <form
            action="{{ route('bacheliers.update', $bachelier->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- input motif de rejet --}}

                <x-forms.textarea
                    class="col-md-12"
                    label="Motif de rejet"
                    name="motif_rejet"
                    required="required"
                    :value="$bachelier->motif_rejet"
                />

            </div>
            <x-buttons.save
                container="edit-bachelier-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

