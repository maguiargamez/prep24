<?php

namespace App\Http\Livewire\Elections;

use App\Http\Traits\WithSelectionItems;
use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use App\Models\PrepElection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Elections extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Elecciones';
    public $breadcrumb = [
        "Elecciones" => 'elections.index',   
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
        return view('livewire.elections.elections', [
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
        return PrepElection::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function destroy($id)
    {
        PrepElection::find($id)->delete();
    }

    public function destroySelected(){

        foreach($this->selectedItems as $key => $idItem){
            PrepElection::find((int)$idItem)->delete();
        }
        $this->resetPage();
    }
}
