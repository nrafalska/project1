<?php

namespace App\Livewire;

use Livewire\Component;

class FilterSortWidget extends Component
{
    public $filters = [];
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function updatedFilters()
    {
        $this->emit('updateFilter', $this->filters);
    }

    public function sortBy($field)
    {
        $this->sortField = $field;
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->emit('updateSort', $this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.filter-sort-widget')
        ->layout('components.layouts.app'); // Обновленный путь к шаблону layout.
    }

}
