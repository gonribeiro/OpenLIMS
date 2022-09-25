<label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label>
<input
    class="form-control form-control-sm"
    type="{{ $type ?? 'text' }}"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ $value ?? '' }}"

    @if(isset($type) && $type == 'number')
        min="{{ $min ?? 0 }}"
        max="{{ $max ?? '' }}"
        step="any"
    @endif

    @if(isset($tooltipText))
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="{{ $tooltipText }}"
    @endif

    @if(isset($required)) required @endif
    @if(isset($disabled)) disabled @endif
>