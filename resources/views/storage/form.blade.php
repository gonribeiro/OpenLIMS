@extends('app')
@section('content')

@if (isset($storage))
    <form action="{{ route('storage.update', $storage) }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('storage.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('storage.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-box-archive"></i>&nbsp; Storage</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-9">
                @include('components.input', ['name' => 'name', 'required' => true, 'value' => $storage->name ?? old('name') ])
            </div>
            <div class="col-md-3">
                @include('components.select', ['name' => 'type', 'required' => true, 'value' => $storage->type ?? old('type'), 'options' => \App\Enums\StorageType::getValues()])
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
    @if (isset($storage))
        <div class="col-md-6" align="right">
            @include('components.buttonDelete', ['urlDestroy' => route('api.storage.destroy', $storage), 'urlRedirect' => route('storage.index')])
        </div>
    @endif
</div>

</form>

<script src="/js/resourceDestroy.js"></script>

<script>
    $('.type').select2({});
</script>

@endsection