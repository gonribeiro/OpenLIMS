@extends('app')
@section('content')

<form action="{{ route('custody.store', $samples->implode('id', ',')) }}" method="post">
@method('POST')
@csrf

<div class="alert alert-info" role="alert">
    <i class="fa-solid fa-circle-info"></i> No update will occur for items where the new storage location is the same as the current storage location.
</div>
<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('sample.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-box-archive"></i> Storage Location</div>
    <div class="card-body bg-light">
        @include('custody.form')
        <br />
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Internal ID</th>
                    <th>Customer</th>
                    <th>Actual Storage Location At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($samples->reverse() as $sample)
                    <tr>
                        <td>{{ $sample->id }}</td>
                        <td>{{ $sample->internalId ?? '-' }}</td>
                        <td>{{ $sample->customer->name }}</td>
                        <td>{{ $sample->lastCustody?->storage->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</form>

<script>
    $(document).ready(function() {
        $('.storage_id').select2({
            ajax: {
                url: {!! json_encode(route('api.storage.index')) !!},
                dataType: 'json',
                delay: 250,
                processResults: function (response, search) {
                    return {
                        results: $.map(response, function (option) {
                            if (search.term != undefined) {
                                if (option.name.toLowerCase().includes(search.term.toLowerCase())) {
                                    return {
                                        id: option.id,
                                        text: option.name
                                    }
                                }
                            } else {
                                return {
                                    id: option.id,
                                    text: option.name
                                }
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>

@endsection