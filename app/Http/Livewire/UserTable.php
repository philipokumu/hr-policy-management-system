<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UserTable extends DataTableComponent
{
     public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Role', 'role')
                ->sortable()
                ->searchable(),
            Column::make('Verified', 'email_verified_at')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            'role' => Filter::make('role')
                ->select([
                    '' => 'Any',
                    'admin' => 'admin',
                    'normal' => 'normal',
                ]),
        ];
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_table';
    }

    public function getTableRowUrl($row): string
    {
    return route('user.assessment.stat', $row);
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('role'), fn ($query, $role) => $query->where('role', $role));
    }
}
