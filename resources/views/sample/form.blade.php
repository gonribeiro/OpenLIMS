@extends('app')
@section('content2')

@if (isset($samples))
    <form action="{{ route('sample.updateByIds') }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('sample.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('sample.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white">Sample</div>
    <div class="card-body bg-light overflow-auto">
        <table class="table table-sm table-hover">
            <tr>
                <th><label>#</label></th>
                @if (isset($samples))
                    <th><label>Tests</label></th>
                    <th><label>Internal_ID</label></th>
                @endif
                <th><label>External_ID*</label></th>
                <th><label>Sample Type*</label></th>
                @if (!isset($samples))
                    <th><label>Analysis/Tests</label></th>
                @endif
                <th><label>Customer*</label></th>
                <th><label>Received*</label></th>
                <th><label>Received by*</label></th>
                @if (!isset($samples))
                    <th><label>Storage</label></th>
                @endif
                <th><label>Collected*</label></th>
                <th><label>Collected by*</label></th>
                <th><label>Volume/Mass*</label></th>
                <th><label>Measurement_Unit*</label></th>
                <th><label>Description</label></th>
                @if (isset($samples))
                    <th><label>Discarded</label></th>
                    <th><label>Discarded by</label></th>
                    <th><label>Cancel</label></th>
                @endif
            </tr>
            @if (!isset($samples))
                @for ($i = 0; $i < $quantity; $i++)
                    @include('sample.components.sampleInput')
                @endfor
            @else
                @foreach ($samples as $i => $sample)
                <input type="hidden" name="samples[{{ $i }}][id]" value="{{ $sample->id }}">
                    @include('sample.components.sampleInput')
                    <tr class="collapse" id="collapseTest{{ $i }}">
                        <td colspan="4">
                            @include('components.selectAjax', [
                                'label' => 'Add analysis/tests',
                                'multiple' => true,
                                'arrayName' => 'samples',
                                'arrayIndex' => $i,
                                'name' => 'tests',
                            ])
                        </td>
                        <td colspan="13"></td>
                    </tr>
                    @foreach ($sample->tests as $test)
                        <tr class="collapse" id="collapseTest{{ $i }}">
                            @include('sample.components.testInput')
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </table>
    </div>
</div>

@include('components.buttonSubmit', ['name' => 'Save'])

</form>

<script src="/js/resourceDestroy.js"></script>

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
