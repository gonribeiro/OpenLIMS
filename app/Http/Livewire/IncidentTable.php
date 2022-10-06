<?php

namespace App\Http\Livewire;

use App\Models\Incident;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Footer, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class IncidentTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        $this->persist(['columns', 'filters']);

        return [
            Footer::make()
                ->showPerPage(intval(env('POWER_GRID_PER_PAGE')), explode(',', env('POWER_GRID_PER_PAGE_VALUES')))
                ->showRecordCount()
        ];
    }

    public function datasource()
    {
        return Incident::query()->orderBy('id', 'desc');
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

            Column::make('SAMPLES', '')
                ->searchable()
                ->makeInputText(),

            Column::make('DESCRIPTION', 'description')
                ->searchable()
                ->makeInputText(),

            Column::make('SOLUTION', 'solution')
                ->searchable()
                ->makeInputText(),

            Column::make('CONCLUSION', 'conclusion')
                ->searchable()
                ->makeInputText(),

            Column::make('NC', 'nc')
                ->searchable()
                ->makeInputText(),
        ];
    }

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('block border border-black-400 rounded py-1.4 px-1
                leading-tight focus:outline-none focus:bg-black-400
                focus:border-black-500 dark:border-slate-500
                hover:bg-dark cursor-pointer text-center bg-primary
                text-white font-semibold')
                ->target('_self')
                ->route('incident.edit', ['incident' => 'id']),
        ];
    }
}
