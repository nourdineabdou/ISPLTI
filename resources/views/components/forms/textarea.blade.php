@props(['name', 'label' => null, 'required' => false, 'value' => null, 'editorClass' => ''])
<div {{ $attributes->merge(['class' => 'form-group mb-3']) }}>
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}
            @if(isset($required) && $required)
                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Field is required">*</span>
            @endif
        </label>
    @endif
    <textarea
        name="{{ $name }}"
        class="form-control {{ $editorClass }}"
        id="{{ $name }}"
    >{{ $value ?? '' }}</textarea>
</div>
