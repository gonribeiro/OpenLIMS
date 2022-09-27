<tr>
    <td>
        @include('components.select', ['label' => 'sample Type', 'name' => 'sample_type', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->sample_type ?? old('sample_type'), 'options' => \App\Enums\SampleType::getValues()])
    </td>
    <td>
        @include('components.selectAjax', ['label' => 'analyses', 'name' => 'tests', 'required' => true, 'hiddenLabel' => true, 'multiple' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'value' => $sample->customer_id ?? old('customer_id')])
    </td>
    <td>
        @include('components.selectAjax', ['label' => 'customer', 'name' => 'customer_id', 'required' => true,  'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->customer_id ?? old('customer_id')])
    </td>
    <td>
        @include('components.input', ['name' => 'externalId', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->externalId ?? old('externalId')])
    </td>
    <td>
        @include('components.input', ['name' => 'received', 'type' => 'date', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->received ?? old('received')])
    </td>
    <td>
        @include('components.selectAjax', ['label' => 'received by', 'name' => 'received_by_id', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->received_by_id ?? old('received_by_id')])
    </td>
    <td>
        @include('components.selectAjax', ['label' => 'storage', 'name' => 'storage_id', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->storage_id ?? old('storage_id')])
    </td>
    <td>
        @include('components.input', ['name' => 'collected', 'type' => 'date', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->collected ?? old('collected')])
    </td>
    <td>
        @include('components.selectAjax', ['label' => 'collected by', 'name' => 'collected_by_id', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->collected_by_id ?? old('collected_by_id')])
    </td>
    <td>
        @include('components.input', ['name' => 'volume', 'type' => 'number', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->volume ?? old('volume')])
    </td>
    <td>
        @include('components.select', ['name' => 'unit', 'required' => true, 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->unit ?? old('unit'), 'options' => \App\Enums\UnitMeasurement::getValues()])
    </td>
    @if (!Request::routeIs('sample.create'))
        <td>
            @include('components.input', ['name' => 'discarded', 'type' => 'date', 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->discarded ?? old('discarded')])
        </td>
        <td>
            @include('components.selectAjax', ['label' => 'discarded by', 'name' => 'discarded_by_id', 'arrayName' => 'samples', 'arrayIndex' => $i, 'hiddenLabel' => true, 'value' => $sample->discarded_by_id ?? old('discarded_by_id')])
        </td>
    @endif
    <td>
        <textarea class="form-control form-control-sm" name="samples[{{ $i }}][description]" rows="1" style="height: 10px;"></textarea>
    </td>
</tr>
