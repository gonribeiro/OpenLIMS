<?php

namespace App\Http\Livewire;

use App\Models\Sample;
use App\Models\Subsample;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class SubsampleTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        $this->persist(['columns', 'filters']);

        $this->showCheckBox();

        return [
            Header::make()->showToggleColumns(),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Footer::make()
                ->showPerPage(intval(env('POWER_GRID_PER_PAGE')), explode(',', env('POWER_GRID_PER_PAGE_VALUES')))
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('edit')
                ->tooltip('Edit Samples')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('edit', []),

            Button::add('viewTestsAndSetResults')
                ->tooltip('View Tests and Set Results')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M175 389.4c-9.8 16-15 34.3-15 53.1c-10 3.5-20.8 5.5-32 5.5c-53 0-96-43-96-96V64C14.3 64 0 49.7 0 32S14.3 0 32 0H96h64 64c17.7 0 32 14.3 32 32s-14.3 32-32 32V309.9l-49 79.6zM96 64v96h64V64H96zM352 0H480h32c17.7 0 32 14.3 32 32s-14.3 32-32 32V214.9L629.7 406.2c6.7 10.9 10.3 23.5 10.3 36.4c0 38.3-31.1 69.4-69.4 69.4H261.4c-38.3 0-69.4-31.1-69.4-69.4c0-12.8 3.6-25.4 10.3-36.4L320 214.9V64c-17.7 0-32-14.3-32-32s14.3-32 32-32h32zm32 64V224c0 5.9-1.6 11.7-4.7 16.8L330.5 320h171l-48.8-79.2c-3.1-5-4.7-10.8-4.7-16.8V64H384z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('viewTestsAndSetResults', []),

            Button::add('newStorageLocation')
                ->tooltip('New Storage Location')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M32 32H480c17.7 0 32 14.3 32 32V96c0 17.7-14.3 32-32 32H32C14.3 128 0 113.7 0 96V64C0 46.3 14.3 32 32 32zm0 128H480V416c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V160zm128 80c0 8.8 7.2 16 16 16H336c8.8 0 16-7.2 16-16s-7.2-16-16-16H176c-8.8 0-16 7.2-16 16z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('newStorageLocation', []),

            Button::add('New Incident')
                ->tooltip('New Incident')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80c0-26.5-21.5-48-48-48S0 53.5 0 80s21.5 48 48 48s48-21.5 48-48zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('newIncident', []),
        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            ['edit', 'viewTestsAndSetResults', 'newStorageLocation', 'newIncident']
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

    public function viewTestsAndSetResults(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(',', $this->checkboxValues);

        redirect(route('result.findResultsBySampleIds', $ids));
    }

    public function newStorageLocation(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(',', $this->checkboxValues);

        redirect(route('custody.create', $ids));
    }

    public function newIncident(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(',', $this->checkboxValues);

        redirect(route('incident.create', $ids));
    }

    public function datasource()
    {
        return Subsample::query()->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [
            'customer' => [
                'name'
            ]
        ];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),

            Column::make('INTERNAL ID', 'internalId')
                ->searchable()
                ->makeInputText(),

            Column::make('VALUE', 'value_unit')
                ->searchable()
                ->makeInputText(),

            Column::make('UNIT', 'unit')
                ->searchable()
                ->makeInputText(),

            Column::make('STORAGE AT', 'storage')
                ->searchable()
                ->makeInputText(),

            Column::make('COLLECTED', 'collected_date')
                ->hidden()
                ->searchable()
                ->makeInputText(),

            Column::make('COLLECTED BY', 'collected_by_id')
                ->hidden()
                ->searchable()
                ->makeInputText(),

            Column::make('RECEIVED', 'received_date')
                ->hidden()
                ->searchable()
                ->makeInputText(),

            Column::make('RECEIVED BY', 'received_by_id')
                ->hidden()
                ->searchable()
                ->makeInputText(),

            Column::make('DISCARDED', 'discarded_date')
                ->hidden()
                ->searchable()
                ->makeInputText(),

            Column::make('DISCARDED BY', 'discarded_by_id')
                ->hidden()
                ->searchable()
                ->makeInputText(),
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
