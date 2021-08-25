{{-- <x-livewire-tables::table.cell> --}}
{{-- Note: This is a tailwind cell --}}
{{-- For bootstrap 4, use <x-livewire-tables::bs4.table.cell> --}}
{{-- For bootstrap 5, use <x-livewire-tables::bs5.table.cell> --}}
{{-- </x-livewire-tables::table.cell> --}}

<x-livewire-tables::table.cell>
    {{ $row->id }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ substr($row->question_text,0, 30) }}...
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->topic->name }}
</x-livewire-tables::table.cell>
