@if(!isset($hiddenLabel))  <label for="{{ $name }}">{{ $label ?? \Str::ucfirst($name) }}@if(isset($required))* @endif</label> @endif
<select
    class="{{ $name }}"
    @if(isset($multiple))
        multiple="multiple"
        @if (isset($subArrayName))
            name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $subArrayName }}][][{{ $name }}]"
        @else
            name="{{ $arrayName }}[][{{ $name }}]"
        @endif
    @else
        @if(isset($arrayName))
            name="{{ $arrayName }}[{{ $arrayIndex }}][{{ $name }}]"
        @else
            name="{{ $name }}"
        @endif
    @endif
    @if(isset($required)) required @endif
    @if(isset($disabled)) disabled @endif
>
    <option value="{{ old('option') }}">{{ old('option') }}</option>
    @if (isset($valueId))
        <option value="{{ $valueId }}" selected="selected">{{ $valueName }}</option>
    @endif
</select>
