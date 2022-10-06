@extends('app')
@section('content')

@if (isset($incident))
    <form action="{{ route('incident.update', $incident) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('incident.store', $samples->implode('id', ',')) }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('incident.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Incident</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-12">
                @include('components.textarea', ['name' => 'description', 'value' => $incident->description ?? old('description'), 'required' => true, 'rows' => 5])
            </div>
            <div class="col-md-12">
                @include('components.textarea', ['name' => 'solution', 'value' => $incident->solution ?? old('solution'), 'rows' => 5])
            </div>
            @if (isset($incident))
                <div class="col-md-12">
                    @include('components.textarea', ['name' => 'conclusion', 'value' => $incident->conclusion ?? old('conclusion'), 'rows' => 5])
                </div>
                <div class="col-md-12">
                    <br />
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="Non-compliance" name="nc" value="1" @if($incident->nc) checked @endif>
                        <label class="form-check-label" for="Non-compliance">Non-compliance</label>
                    </div>
                </div>
            @endif
        </div>
        <br />
        @if (!isset($incident))
            @include('sample.components.listOfSamples')
        @else
            @include('sample.components.listOfSamples', ['samples' => $incident->samples])
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
    @if (isset($incident))
        <div class="col-md-6" align="right">
            @include('components.buttonDelete', ['urlDestroy' => route('api.incident.destroy', $incident), 'urlRedirect' => route('incident.index')])
        </div>
    @endif
</div>
<br />

</form>

<script src="/js/resourceDestroy.js"></script>

@endsection