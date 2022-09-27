@if(!isset($hiddenLabel))  <label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label> @endif
<select
    class="{{ $name }}"
    @if(isset($multiple)) multiple="multiple" name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $name }}][]" @endif
    @if(isset($arrayName)) name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $name }}]" @else name="{{ $name }}" @endif
    @if(isset($required)) required @endif
>
    <option value="{{ old('option') }}">{{ old('option') }}</option>
</select>
