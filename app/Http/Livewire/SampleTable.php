<?php

namespace App\Http\Livewire;

use App\Models\Sample;
use App\Models\User;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SampleTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        // $this->persist(['columns', 'filters']);

        $this->showCheckBox();

        return [
            Header::make()->showToggleColumns(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Footer::make()
                ->showPerPage(intval(env('POWER_GRID_PER_PAGE')), explode(',', env('POWER_GRID_PER_PAGE_VALUES')))
                ->showRecordCount()
        ];
    }

    public function header(): array
    {
        return [
            Button::add('create')
                ->tooltip('New Sample')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->target('_self')
                ->route('sample.sampleQuantityDialog', ['']),

            Button::add('edit')
                ->tooltip('Edit Samples')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('edit', []),
        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            ['edit']
        );
    }

    public function edit(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(',', $this->checkboxValues);

        redirect(route('sample.edit', $ids));
    }

    public function datasource()
    {
        return Sample::query()->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent();
    }

    public function columns(): array
    {
        return [
            Column::make('SAMPLE TYPE', 'sample_type')
                ->searchable()
                ->makeInputText(),

            Column::make('INTERNAL ID', 'internalId')
                ->searchable()
                ->makeInputText(),

            Column::make('EXTERNAL ID', 'externalId')
                ->searchable()
                ->makeInputText(),

            Column::make('CUSTOMER', 'customer_id')
                ->searchable()
                ->makeInputText(),

            Column::make('VALUE', 'value_unit')
                ->searchable()
                ->makeInputText(),

            Column::make('UNIT', 'unit')
                ->searchable()
                ->makeInputText(),
                
            Column::make('STATUS', 'status')
                ->searchable()
                ->makeInputText(),

            Column::make('COLLECTED', 'collected_date')
                ->searchable()
                ->makeInputText(),

            Column::make('COLLECTED BY', 'collected_by_id')
                ->searchable()
                ->makeInputText(),

            Column::make('RECEIVED', 'received_date')
                ->searchable()
                ->makeInputText(),

            Column::make('RECEIVED BY', 'received_by_id')
                ->searchable()
                ->makeInputText(),

            Column::make('DISCARDED', 'discarded_date')
                ->searchable()
                ->makeInputText(),

            Column::make('DISCARDED BY', 'discarded_by_id')
                ->searchable()
                ->makeInputText(),
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
