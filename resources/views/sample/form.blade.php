@extends('app')
@section('content2')

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
    <div class="card-body bg-light overflow-auto">
        <table class="table table-sm table-hover">
            <tr>
                <th><label>Sample Type*</label></th>
                <th><label>Analysis/Tests*</label></th>
                <th><label>Customer*</label></th>
                <th><label>External_ID*</label></th>
                <th><label>Received*</label></th>
                <th><label>Received by*</label></th>
                <th><label>Storage*</label></th>
                <th><label>Collected*</label></th>
                <th><label>Collected by*</label></th>
                <th><label>Volume/Mass*</label></th>
                <th><label>Measurement_Unit*</label></th>
                @if (!Request::routeIs('sample.create'))
                    <th><label>Discarded</label></th>
                    <th><label>Discarded by</label></th>
                @endif
                <th><label>Description</label></th>
            </tr>
            @for ($i = 0; $i < $quantity; $i++)
                @include('sample.components.sampleInput')
            @endfor
        </table>
    </div>
</div>

@include('components.buttonSubmit', ['name' => 'Save'])

</form>

<script>
    // select2
    $(document).ready(function() {
        $('.select2, .unit, .sample_type').select2({});

        $('.tests').select2({
            ajax: {
                url: {!! json_encode(route('api.analysis.index')) !!},
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

        $('.customer_id, .received_by_id, .collected_by_id, .discarded_by_id').select2({
            ajax: {
                url: {!! json_encode(route('api.user.index')) !!},
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
