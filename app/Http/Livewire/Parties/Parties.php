<?php

namespace App\Http\Livewire\Parties;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\PartyCoalition;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Parties extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Partidos y coaliciones';
    public $breadcrumb = [
        "Partidos y coaliciones" => 'parties.index',   
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
        return view('livewire.parties.parties', [
            'items' => $this->items
        ]);
    }

    public function resetVars()
    {
        $this->reset();
        $this->resetPage();
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
        return PartyCoalition::query()
            ->search(trim($this->search))
            ->with('election')
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function destroy($id)
    {
        PartyCoalition::find($id)->delete();
    }

    public function destroySelected(){

        foreach($this->selectedItems as $key => $idItem){
            PartyCoalition::find((int)$idItem)->delete();
        }
        $this->resetPage();
    }
}
