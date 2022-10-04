<div class="row">
    <div class="col-md-5">
        @include('components.selectAjax', [
            'label' => 'New storage location',
            'name' => 'storage_id',
            'required' => true,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Reason for change',
            'name' => 'reason',
            'type' => 'text',
            'required' => true,
        ])
    </div>
    <div class="col-md-1 text-center">
        <br />
        @include('components.buttonSubmit', ['name' => 'Save'])
    </div>
</div>