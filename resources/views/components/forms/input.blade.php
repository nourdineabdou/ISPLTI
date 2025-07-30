@props([
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'type' => 'text',
    'value' => null,
    'dataFilter' => null,
    'inputClass' => null,

])
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}
            @if(isset($required) && $required)
                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="field is required">*</span>
            @endif
        </label>
    @endif
    <input type="{{ $type ?? 'text' }}"
           class="form-control {{ $inputClass ?? '' }}"
           {{--           {{ $attributes->merge(['class' => 'form-ccontrol'])}}--}}
           id="{{ $name }}"
           data-filter="{{ $dataFilter ?? '' }}"
           placeholder="{{ $placeholder ?? '' }}"
           name="{{ $name ?? null }}"
           value="{{ $value ?? null }}"
    >
</div>
