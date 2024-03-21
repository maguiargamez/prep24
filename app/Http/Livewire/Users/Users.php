<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\EcoUser;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Users extends Component
{
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Usuarios';
    public $breadcrumb = [
        "Super Administración" => null,
        "Usuarios" => "users.index",  
    ];

    public $currentRouteName= '';
    public $selectAllItems = false;
    public $selectedItems = [];
    public $paginate = 10;    
    public $search = '';

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    public function render()
    {        
        return view('livewire.users.users', [
            'items' => $this->items,
        ]);
    }
    
    public function updatedSelectedItems()
    {        
        if(count($this->selectedItems)<count($this->itemsQuery->pluck('id')->toArray())){
            $this->selectAllItems= false;
        }
        if(count($this->selectedItems)>=count($this->itemsQuery->pluck('id')->toArray())){
            $this->selectAllItems= true;
        }        
    }

    public function updatingSelectAllItems()
    {
        $this->toggleSelectAllItems();
    }
    
    public function toggleSelectAllItems()
    {
        $this->selectAllItems = !$this->selectAllItems;
        if ($this->selectAllItems) {
            $this->selectedItems = $this->itemsQuery->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
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
        return EcoUser::query()
            ->with('ecoUserType')
            ->with('ecoUserStatus')
            ->search(trim($this->search))
            ->orderBy('id', 'DESC')
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
    }

    public function destroySelected(){

        foreach($this->selectedItems as $key => $idItem){
            User::find((int)$idItem)->delete();
        }
        $this->resetPage();
    }
}
