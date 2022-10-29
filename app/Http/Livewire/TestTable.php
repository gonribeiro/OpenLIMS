<?php

namespace App\Http\Livewire;

use App\Models\Test;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TestTable extends PowerGridComponent
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
                ->showRecordCount()
        ];
    }

    public function header(): array
    {
        return [
            Button::add('findResultsByTestIds')
                ->tooltip('New Test Result')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('findResultsByTestIds', []),

            Button::add('cancelTest')
                ->tooltip('Cancel Test')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->emit('cancelTest', []),
        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            ['findResultsByTestIds', 'cancelTest']
        );
    }

    public function findResultsByTestIds(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(',', $this->checkboxValues);

        redirect(route('result.findResultsByTestIds', $ids));
    }

    public function datasource()
    {
        return Test::query()->orderBy('id', 'desc');
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
            Column::make('ID', 'id'),

            Column::make('SAMPLE', 'sample_id')
                ->searchable()
                ->makeInputText(),

            Column::make('ANALYSIS', 'analysis_id')
                ->searchable()
                ->makeInputText(),
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
