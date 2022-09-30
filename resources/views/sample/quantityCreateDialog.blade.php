@extends('app')
@section('content')

<form action="{{ route('sample.create') }}" method="get">
@csrf

<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Sample</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-12">
                @include('components.input', ['name' => 'quantity', 'required' => true, 'type' => 'number'])
            </div>
        </div>
    </div>
</div>

@include('components.buttonSubmit', ['name' => 'Continue'])

</form>

@endsection
