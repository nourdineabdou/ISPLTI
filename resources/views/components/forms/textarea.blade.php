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
{{--        {{ $attributes->merge(['class' => 'form-control'])}}--}}
        class="form-control"
        id="{{ $name }}"
    >{{ $value ?? '' }}</textarea>
</div>
