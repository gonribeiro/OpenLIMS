@extends('app')
@section('content')

@if (isset($analysi))
    <form action="{{ route('analysis.update', $analysi) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('analysis.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('analysis.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Analysis</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-9">
                @include('components.input', ['name' => 'name', 'required' => true, 'value' => $analysi->name ?? old('name')])
            </div>
            <div class="col-md-3">
                @include('components.select', ['label' => 'Sample Type', 'name' => 'sample_type', 'required' => true, 'value' => $analysi->sample_type ?? old('sample_type'), 'options' => \App\Enums\SampleType::getValues()])
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('components.textarea', ['name' => 'description', 'value' => $analysi->description ?? old('description')])
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('components.textarea', ['name' => 'attributes', 'required' => true, 'row' => 5, 'value' => $analysi->attributes ?? old('attributes')])
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
    @if (isset($analysi))
        <div class="col-md-6" align="right">
            @include('components.buttonDelete', ['urlDestroy' => route('api.analysis.destroy', $analysi), 'urlRedirect' => route('analysis.index')])
        </div>
    @endif
</div>

</form>

<script>
    $('.sample_type').select2({});
</script>

@endsection