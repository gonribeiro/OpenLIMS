@extends('app')
@section('content2')

@if (isset($samples))
    <form action="{{ route('subsample.updateByIds') }}" method="post">
    @method('PATCH')
@else
    <form action="{{ route('subsample.store') }}" method="post">
    @method('POST')
@endif
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('subsample.index'), 'color' => 'link'])
</div>
<font size="2">
    <div class="card text-black bg-dark mb-3">
        <div class="card-header text-white"><i class="fa-solid fa-vial"></i>&nbsp; Sample</div>
        <div class="card-body bg-light overflow-auto">
            <table class="table table-sm table-hover">
                <tr>
                    <th><label>#</label></th>
                    @if (isset($samples))
                        <th><label><i class="fa-solid fa-flask-vial"></i> Tests</label></th>
                        <th><label>Results</label></th>
                        <th><label>Internal ID</label></th>
                    @endif
                    <th><label>External ID*</label></th>
                    <th><label><i class="fa-solid fa-vial"></i> Sample Type*</label></th>
                    @if (!isset($samples))
                        <th><label><i class="fa-solid fa-microscope"></i> Analysis</label></th>
                    @endif
                    <th><label><i class="fa-solid fa-user"></i> Customer*</label></th>
                    <th><label>Received*</label></th>
                    <th><label>Received by*</label></th>
                    <th><label><i class="fa-solid fa-box-archive"></i> Storage Location</label></th>
                    <th><label>Collected*</label></th>
                    <th><label>Collected by*</label></th>
                    <th><label>Volume/Mass*</label></th>
                    <th><label>Unit*</label></th>
                    <th><label>Description</label></th>
                    @if (isset($samples))
                        <th><label>Discarded</label></th>
                        <th><label>Discarded by</label></th>
                        <th><label>Action</label></th>
                    @endif
                </tr>
                @if (!isset($samples))
                    @for ($i = 0; $i < $quantity; $i++)
                        @include('subsample.components.sampleInput')
                    @endfor
                @else
                    @foreach ($samples as $i => $subsample)
                        <input type="hidden" name="samples[{{ $i }}][id]" value="{{ $subsample->id }}">
                        @include('subsample.components.sampleInput')
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</font>

@include('components.buttonSubmit', ['name' => 'Save'])

</form>

@include('components.modal')

<script src="/js/resourceDestroy.js"></script>

<script>
    $(document).ready(function() {
        $('.unit, .sample_type').select2({});

        $('.analysis_id').select2({
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

    function loadModal(route) {
        $('.iframeModal').attr('src', route);

        $('#myModal').modal('show');
    }

    function cleanIframe() {
        $('.iframeModal').attr('src', '');
    }
</script>

@endsection
