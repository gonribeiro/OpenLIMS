@extends('app')
@section('content')

@php $hiddenNavbar = true @endphp

<form action="{{ route('custody.store', $sample) }}" method="post">
@method('POST')
@csrf

<div class="alert alert-info" role="alert">
    <i class="fa-solid fa-circle-info"></i> If you change the storage location, refresh the page to view your changes in the sample edit page.
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-box-archive"></i> Storage Location</div>
    <div class="card-body bg-light">
        @include('custody.form')
        <br />
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Latest storage Location</th>
                    <th>Reason</th>
                    <th>Created At</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sample->custodies->reverse() as $custody)
                    <tr>
                        <td>{{ $custody->storage?->name }}</td>
                        <td>{{ $custody->reason ?? 'First storage location' }}</td>
                        <td>{{ $custody->created_at }}</td>
                        <td>-</td>
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