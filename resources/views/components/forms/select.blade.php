@props([
    'name' => null,
    'label' => null,
    'required' => false,
    'options' => collect(),
    'value' => null,
    'dataPlaceholder' => 'Select an option',
    'id' => null,
    'onchange' => null,
    'valueField' => 'id', // Field name for option value
    'labelField' => 'name', // Field name for option label
    'selectClass' => 'select2',
    'dataFilter'=>'',
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}
            @if($required)
                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Field is required">*</span>
            @endif
        </label>
    @endif
    <select
        onchange="{{ $onchange ?? null }}"
        class="form-control {{ $selectClass }}"
        data-placeholder="{{ $dataPlaceholder }}"
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        data-filter="{{ $dataFilter?? '' }}"
    >
        <option></option>
        @if($options instanceof \Illuminate\Support\Collection && $options->isNotEmpty())
            @foreach($options as $option)
                <option value="{{ $option[$valueField] }}"
                    {{ isset($value) && $value == $option[$valueField] ? 'selected' : '' }}>
                    {{ $option[$labelField] }}
                </option>
            @endforeach
        @else
            @foreach($options as $key => $option)
                <option value="{{ $key }}"
                    {{ isset($value) && $value == $key ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        @endif
    </select>
</div>
