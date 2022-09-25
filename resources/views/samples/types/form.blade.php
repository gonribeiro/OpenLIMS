@extends('app')
@section('content')

@if (isset($sampleType))
    <form action="{{ route('sampleType.update', $sampleType) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('sampleType.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Sample Type</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-11">
                @include('components.input', ['name' => 'name', 'required' => true, 'value' => $sampleType->name ?? old('name') ])
            </div>
            @if (isset($sampleType))
                <div class="col-md-1">
                    <label for="enabled_disable" id="label_enabled_disable">Enabled</label>
                    <div class="form-check form-switch text-center">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="enabled_disable"
                            role="switch"
                            name="enabled"
                            @if (!$sampleType->deleted_at)
                                checked
                            @endif
                        >
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@include('components.buttonSubmit', ['name' => 'Save'])

</form>

@if (isset($sampleType))
    <script>
        checkboxInputLabel($('#enabled_disable').prop('checked'));

        $('#enabled_disable').change(function() {
            if (this.checked) {
                checkboxInputLabel(this.checked);
            } else {
                checkboxInputLabel(this.checked);
            }
        });

        function checkboxInputLabel(checked) {
            if (checked === true) {
                $('input[name=name]').prop('disabled', false);
                $('#label_enabled_disable').text('Enabled');
            } else {
                $('input[name=name]').prop('disabled', true);
                $('#label_enabled_disable').text('Disabled');
            }
        }
    </script>
@endif

@endsection