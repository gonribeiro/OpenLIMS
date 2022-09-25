<label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label>
<select
    class="{{ $name }}"
    name="{{ $name }}"
    @if(isset($required)) required @endif
>
    <option value="{{ old('option') }}">{{ old('option') }}</option>
    @foreach($options as $option)
        <option @if(isset($value) && $value == $option) selected @endif value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
