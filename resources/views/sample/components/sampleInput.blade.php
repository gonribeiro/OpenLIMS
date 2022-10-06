<tr>
    <td>
        {{ $i }}
    </td>
    @if (isset($sample))
        <td class="text-center">
            <button
                type="button"
                class="input-group-text btn-sm"
                onclick="loadModal(`{{ route('test.edit', $sample) }}`)"
            >
                <i class="fa-solid fa-arrow-up-right-from-square"></i>&nbsp;
                {{ $sample->tests?->count() }}
            </button>
        </td>
        <td>
            @include('components.input', [
                'name' => 'internalId',
                'disabled' => true,
                'hiddenLabel' => true,
                'value' => $sample->internalId ?? old('samples.internalId')
            ])
        </td>
    @endif
    <td>
        @include('components.input', [
            'name' => 'externalId',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => $sample->externalId ?? old('samples.externalId')
        ])
    </td>
    <td>
        @include('components.select', [
            'label' => 'sample Type',
            'name' => 'sample_type',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => $sample->sample_type ?? old('sample_type'),
            'options' => \App\Enums\SampleType::getValues()
        ])
    </td>
    @if (!isset($sample))
        <td>
            @include('components.selectAjax', [
                'label' => 'analyses',
                'hiddenLabel' => true,
                'multiple' => true,
                'arrayName' => 'samples',
                'arrayIndex' => $i,
                'subArrayName' => 'tests',
                'name' => 'analysis_id',
            ])
        </td>
    @endif
    <td>
        @include('components.selectAjax', [
            'label' => 'customer',
            'name' => 'customer_id',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'valueId' => $sample->customer_id ?? old('customer_id'),
            'valueName' => $sample->customer->name ?? old('customer_id')
        ])
    </td>
    <td>
        @include('components.input', [
            'name' => 'received_date',
            'type' => 'date',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => isset($sample) ? $sample->received_date->format('Y-m-d') : old('received_date')
        ])
    </td>
    <td>
        @include('components.selectAjax', [
            'label' => 'received by',
            'name' =>
            'received_by_id',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'valueId' => $sample->received_by_id ?? old('received_by_id'),
            'valueName' => $sample->receivedBy->name ?? old('received_by_id')
        ])
    </td>
    <td>
        @if (!isset($sample))
            @include('components.selectAjax', [
                'label' => 'storage',
                'arrayName' => 'custody',
                'name' => 'storage_id',
                'arrayName' => 'samples',
                'arrayIndex' => $i,
                'hiddenLabel' => true,
                'valueId' => $sample->lastCustody->storage->id ?? old('storage_id'),
                'valueName' => $sample->lastCustody->storage->name ?? old('storage_id')
            ])
        @else
            <button
                type="button"
                class="input-group-text btn-sm"
                onclick="loadModal(`{{ route('custody.edit', $sample) }}`)"
            >
                <i class="fa-solid fa-arrow-up-right-from-square"></i> &nbsp;{{ $sample->lastCustody?->storage?->name ?? 'No storage' }}
            </button>
        @endif
    </td>
    <td>
        @include('components.input', [
            'name' => 'collected_date',
            'type' => 'date',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => isset($sample) ? $sample->collected_date->format('Y-m-d') : old('collected_date')
        ])
    </td>
    <td>
        @include('components.selectAjax', [
            'label' => 'collected by',
            'name' => 'collected_by_id',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'valueId' => $sample->collected_by_id ?? old('storage_id'),
            'valueName' => $sample->collectedBy->name ?? old('storage_id')
        ])
    </td>
    <td>
        @include('components.input', [
            'name' => 'value_unit',
            'type' => 'number',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => $sample->value_unit ?? old('volume')
        ])
    </td>
    <td>
        @include('components.select', [
            'name' => 'unit',
            'required' => true,
            'arrayName' => 'samples',
            'arrayIndex' => $i,
            'hiddenLabel' => true,
            'value' => $sample->unit ?? old('unit'),
            'options' => \App\Enums\UnitMeasurement::getValues()
        ])
    </td>
    <td>
        <textarea
            class="form-control form-control-sm"
            name="samples[{{ $i }}][description]"
            rows="1"
            style="height: 10px;"
        >{{ $sample->description ?? '' }}</textarea>
    </td>
    @if (isset($sample))
        <td>
            @include('components.input', [
                'name' => 'discarded_date',
                'type' => 'date',
                'arrayName' => 'samples',
                'arrayIndex' => $i,
                'hiddenLabel' => true,
                'value' => isset($sample) ? $sample->discarded_date?->format('Y-m-d') : old('discarded_date')
            ])
        </td>
        <td>
            @include('components.selectAjax', [
                'label' => 'discarded by',
                'name' => 'discarded_by_id',
                'arrayName' => 'samples',
                'arrayIndex' => $i,
                'hiddenLabel' => true,
                'valueId' => $sample->discarded_by_id ?? old('storage_id'),
                'valueName' => $sample->discardedBy->name ?? old('storage_id')
            ])
        </td>
        <td> 
            @include('components.buttonDelete', [
                'urlDestroy' => route('api.sample.destroy', $sample),
                'urlRedirect' => route('sample.edit', $samples->implode('id', ','))
            ])
        </td>
    @endif
</tr>
