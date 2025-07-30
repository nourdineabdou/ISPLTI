@props([
    'class' => 'mb-2',
    'name',
     'label',
     'required' => false,
     'type' => 'file',
     'accept' => 'image/*, application/pdf',
        'multiple' => false,

     ])
<div class="{{ $class }}">
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}
            @if(isset($required) && $required)
                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="field is required">*</span>
            @endif
        </label>
    @endif
    <input
        accept="{{ $accept }}"
        name="{{ $name }}"
        type="{{ $type }}"
           {{ $attributes->merge(['class' => 'form-control'])}}
{{--           id="{{ $name }}"--}}
    >
</div>

