<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Question;

class QuestionTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Question','question_text')
                ->sortable()
                ->searchable(),
            Column::make('Topic','topic')
            // ->sortable()
            // ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Question::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.question_table';
    }
}
