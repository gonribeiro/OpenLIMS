<label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label>
<textarea
    class="form-control"
    id="{{ $name }}"
    name="{{ $name }}"
    rows="{{ $rows ?? 3 }}"
    @if(isset($required)) required @endif
    @if(isset($disabled)) disabled @endif
>{{ $value ?? '' }}</textarea>