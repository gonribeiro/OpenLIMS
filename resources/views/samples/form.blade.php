@extends('app')
@section('content')

@if (isset($sample))
    <form action="{{ route('sample.update', $sample) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('sample.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Sample {{ $sample->externalId ?? '' }}</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-2">
                @include('components.input', [
                    'name' => 'externalId',
                    'required' => true,
                    'label' => 'External ID',
                    'value' => $sample->externalId ?? old('externalId')
                ])
            </div>
            <div class="col-md-4">
                <label for="SampleType">Sample Type*</label>
                <select class="select2" name="sample_type_id" required>
                    <option></option>
                    @foreach ($sampleTypes as $sampleType)
                        <option
                            value="{{ $sampleType->id }}"
                            @if(isset($sample) && $sample->user_id == $sampleType->id) selected @endif
                        >
                            {{ $sampleType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="Customer">Customer*</label>
                <select class="select2" name="customer_id" required>
                    <option></option>
                    @foreach ($users as $user)
                        <option
                            value="{{ $user->id }}"
                            @if(isset($sample) && $sample->user_id == $user->id) selected @endif
                        >
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                @include('components.input', [
                    'name' => 'received',
                    'type' => 'date',
                    'required' => true,
                    'value' => $sample->received ?? old('received')
                ])
            </div>
            <div class="col-md-4">
                <label for="SampleType">Storage at*</label>
                <select class="select2" name="storage_id" required>
                    <option></option>
                    @foreach ($sampleTypes as $sampleType)
                        <option
                            value="{{ $sampleType->id }}"
                            @if(isset($sample) && $sample->user_id == $sampleType->id) selected @endif
                        >
                            {{ $sampleType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="ReceivedBy">Received by*</label>
                <select class="select2" name="received_by_id" required>
                    <option></option>
                    @foreach ($users as $user)
                        <option
                            value="{{ $user->id }}"
                            @if(isset($sample) && $sample->received_by_id == $user->id) selected @endif
                        >
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                @include('components.input', [
                    'name' => 'collected',
                    'type' => 'date',
                    'required' => true,
                    'value' => $sample->collected ?? old('collected')
                ])
            </div>
            <div class="col-md-3">
                @include('components.input', [
                    'name' => 'volume',
                    'label' => 'Volume/Mass',
                    'type' => 'number',
                    'required' => true,
                    'value' => $sample->volume ?? old('volume')
                ])
            </div>
            <div class="col-md-3">
                <label for="SampleType">Measurement unit</label>
                <select class="select2" name="sample_type_id">
                    <option></option>
                    @foreach ($sampleTypes as $sampleType)
                        <option
                            value="{{ $sampleType->id }}"
                            @if(isset($sample) && $sample->user_id == $sampleType->id) selected @endif
                        >
                            {{ $sampleType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                @include('components.input', [
                    'name' => 'discarded',
                    'type' => 'date',
                    'required' => true,
                    'value' => $sample->discarded ?? old('discarded')
                ])
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="ps">P.S.</label>
                <textarea class="form-control" name="ps" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>

@include('components.buttonSubmit', ['name' => 'Save'])

</form>

<script>
    // select2
    $(document).ready(function() {
        $('.select2').select2({});
    });
</script>

@endsection