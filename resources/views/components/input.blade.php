@if(!isset($hiddenLabel)) <label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label> @endif
<input
    class="form-control form-control-sm {{ $class ?? '' }}"
    type="{{ $type ?? 'text' }}"
    style="min-width: 150px"
    @if(isset($arrayName)) name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $name }}]" @else name="{{ $name }}" @endif
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