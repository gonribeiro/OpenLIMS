@extends('app')
@section('content2')

<form action="{{ route('result.storeOrUpdate') }}" method="post">
@method('POST')
@csrf

<div align="right">
    @include('components.buttonLink', ['name' => 'Back', 'url' => route('sample.index'), 'color' => 'link'])
</div>
<div class="card text-black bg-dark mb-3">
    <div class="card-header text-white"><i class="fa-solid fa-flask-vial"></i>&nbsp; Tests and Result</div>
    <div class="card-body bg-light overflow-auto">
        @if ($samplesWithoutTests->isNotEmpty())
            <tr>
                <td>
                    <div class="alert alert-info" role="alert">
                        <i class="fa-solid fa-circle-info"></i> <strong>Samples</strong> {{ $samplesWithoutTests->pluck('internalId')->implode(', ', 'internalId') }} <strong>doenst have tests and results</strong>.
                    </div>
                </td>
            </tr>
        @endif
        <tr>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input result" type="checkbox" role="switch" id="enableAllResult">
                    <label class="form-check-label">Enable all results to set or update values</label>
                </div>
                <br />
            </td>
        </tr>
        @foreach ($samplesWithTests as $sample)
            @foreach ($sample->tests as $test)
                <table>
                    <tr>
                        <td>
                            <label>&nbsp;</label> <br />
                            <div
                                class="form-check form-switch"
                                data-bs-toggle="tooltip"
                                data-bs-placement="right"
                                title="Set or update result"
                            >
                                <input
                                    class="form-check-input result"
                                    type="checkbox"
                                    role="switch"
                                    value="{{ $test->id }}"
                                    onclick="enableOrDisableInput()"
                                    >
                            </div>
                        </td>
                        <td>
                            <label><i class="fa-solid fa-vial"></i> Sample</label>
                            <button
                                type="button"
                                class="input-group-text btn-sm"
                                disabled
                                style="max-width: 200px; min-width: 100px"
                            >
                                {{ $test->sample->internalId }}
                            </button>
                        </td>
                        <td>
                            <label><i class="fa-solid fa-microscope"></i> Analysis</label>
                            <button
                                type="button"
                                class="input-group-text btn-sm"
                                disabled
                                style="max-width: 200px; min-width: 150px"
                            >
                                {{ $test->analysis->name }}
                            </button>
                        </td>
                        @if ($test->results->isNotEmpty()) <!-- Result has test -->
                            @foreach ($test->results as $result)
                                <td>
                                    <input type="hidden" class="{{ $test->id }}" name="results[{{ $result->id }}][result_id]" value="{{ $result->id }}" disabled>
                                    @include('components.input', [
                                        'name' => $result->name,
                                        'type' => json_decode($result->config)->type,
                                        'class' => $test->id,
                                        {{-- 'required' => json_decode($result->config)->required, --}}
                                        'arrayName' => 'results',
                                        'arrayIndex' => $result->id,
                                        'value' => $result->value,
                                        'disabled' => true
                                    ])
                                </td>
                            @endforeach
                        @else <!-- Result doenst have result -->
                            <input type="hidden" class="{{ $test->id }}" name="results[{{ $test->id }}][test_id]" value="{{ $test->id }}" disabled>
                            @foreach (json_decode($test->analysis->attributes) as $attribute)
                                <td>
                                    @include('components.input', [
                                        'name' => $attribute->name,
                                        'type' => $attribute->config->type,
                                        'class' => $test->id,
                                        'required' => $attribute->config->required,
                                        'arrayName' => 'results',
                                        'arrayIndex' => $test->id,
                                        'disabled' => true
                                    ])
                                </td>
                            @endforeach
                        @endif
                    </tr>
                </table>
            @endforeach
            <br />
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
</div>

</form>

<script>
    $('.type').select2({});

    $('form *:not(:button,.result,input[name=_token])').prop('disabled', true); // set initial inputs disabled
    $(".result").prop("checked", false); // set initial checkboxes false

    var enableResults = false; // conditional to enable or disable all checkboxes
    $("#enableAllResult").on("change", function() {
        $(".result").prop("checked", !enableResults);

        enableResults = !enableResults;

        enableOrDisableInput();
    });

    function enableOrDisableInput() {
        $.each($(".result:checked"), function() {
            let inputId = $(this).val();

            $("." + inputId).prop("disabled", false);
        });

        $.each($(".result:not(:checked)"), function() {
            let inputId = $(this).val();

            $("." + inputId).prop("disabled", true);
        });
    }
</script>

@endsection