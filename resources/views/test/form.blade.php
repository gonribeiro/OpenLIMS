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