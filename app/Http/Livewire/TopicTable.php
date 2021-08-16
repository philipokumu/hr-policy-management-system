<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Topic;

class TopicTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Topic name', 'name')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Topic::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.topic_table';
    }
}
