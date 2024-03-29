@if(!isset($hiddenLabel))  <label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label> @endif
<select
    class="{{ $name }}"
    @if(isset($multiple)) multiple="multiple" @endif
    @if(isset($arrayName)) name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $name }}]" @else name="{{ $name }}" @endif
    @if(isset($required)) required @endif
>
    <option value="{{ old('option') }}">{{ old('option') }}</option>
    @foreach($options as $option)
        <option @if(isset($value) && $value == $option) selected @endif value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
