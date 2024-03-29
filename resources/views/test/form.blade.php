@extends('app')
@section('content')

@php $hiddenNavbar = true @endphp

<form action="{{ route('test.store', $sample) }}" method="post">
@method('POST')
@csrf

<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-flask-vial"></i>&nbsp; Tests</div>
    <div class="card-body bg-light">
        <div class="row">
            <div class="col-md-11">
                @include('components.selectAjax', [
                    'label' => 'Add Analysis/Tests',
                    'multiple' => true,
                    'arrayName' => 'tests',
                    'name' => 'analysis_id',
                ])
            </div>
            <div class="col-md-1 text-center">
                <br />
                @include('components.buttonSubmit', ['name' => 'Save'])
            </div>
        </div>
        <br />
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sample->tests->reverse() as $test)
                    @include('test.components.testInput')
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</form>

<script src="/js/resourceDestroy.js"></script>

<script>
    $(document).ready(function() {
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
    });
</script>

@endsection