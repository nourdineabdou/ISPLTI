@props([
    'text' => 'Enregistrer',
])
<div class="d-flex justify-content-end">
    <button type="button" {{ $attributes->merge(['class' => 'btn btn-success btn-sm'])}} >
        <i class="la la-save main-icon"></i>
        <span class="indicator-progress d-none">
        <span class="spinner-border spinner-border-sm align-middle ms-2">
        </span>
    </span> {{$text}}
        <i class="la la-check well-saved d-none"></i>
    </button>
</div>
