<?php

namespace App\Http\Livewire;

use App\Models\User;
use PowerComponents\LivewirePowerGrid\Rules\{RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class UserTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        $this->persist(['columns', 'filters']);

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
            Button::add('newUser')
                ->tooltip('New User')
                ->caption(__('<svg xmlns="http://www.w3.org/2000/svg" viewBox="-40 -50 550 600" class="h-6 w-5
                text-slate-500 dark:text-slate-300"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/></svg>'))
                ->class('cursor-pointer block bg-indigo-500 text-slate-700 border border-gray-300 rounded py-1.5 px-3
                leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500
                dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300 mt-2')
                ->target('_self')
                ->route('user.create', ['']),
        ];
    }

    public function datasource()
    {
        return User::query()->orderBy('id', 'desc');
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

            Column::make('NAME', 'name')
                ->searchable()
                ->makeInputText(),

            Column::make('EMAIL', 'email')
                ->searchable()
                ->makeInputText(),

            // Column::make('DISABLED AT', 'deleted_at')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),
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
                ->route('user.edit', ['user' => 'id']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
}
