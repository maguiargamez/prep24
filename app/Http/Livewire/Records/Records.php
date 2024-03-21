<?php

namespace App\Http\Livewire\Records;

use App\Http\Traits\WithSelectionItems;
use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Records extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Actas';
    public $breadcrumb = [
        "Actas" => null,   
    ];

    public $currentRouteName= '';

    public $paginate = 10;    
    public $search = '';

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    public function render()
    {
        return view('livewire.records.records', [
            'items' => $this->items
        ]);
    }

    public function resetVars()
    {
        $this->reset();
        $this->resetPage();
        //$this->resetFiltros();
    }

    public function mountWithSorting()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }

    public function mount()
    {
        $this->resetVars();
        $this->currentRouteName= Route::currentRouteName();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getItemsQueryProperty()
    {
        return PollingPlace::query()
            ->with('election')
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }


}
