@props([
    'class' => 'mb-2',
    'name',
     'label',
     'required' => false,
     'type' => 'file',
     'accept' => 'image/*, application/pdf',
        'multiple' => false,
        'previewMultiple' => false,

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
    <div @if($previewMultiple) class="simple-file-uploader" @endif>
        <input
            accept="{{ $accept }}"
            name="{{ $name }}"
            type="{{ $type }}"
            @if($multiple) multiple @endif
               {{ $attributes->merge(['class' => 'form-control' . ($previewMultiple ? ' js-simple-multi-file-input' : '')])}}
{{--           id="{{ $name }}"--}}
        >
        @if($previewMultiple)
            <div class="files-preview mt-2 d-flex flex-wrap"></div>
        @endif
    </div>
</div>

