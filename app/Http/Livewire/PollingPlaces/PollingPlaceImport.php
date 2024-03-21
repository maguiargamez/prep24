<?php

namespace App\Http\Livewire\PollingPlaces;

use App\Imports\PollingPlacesImport;
use App\Models\Election;
use App\Models\PollingPlace;
use App\Models\PollingPlaceTmp;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\WithSorting;
use Livewire\WithPagination;
use App\Http\Traits\WithSelectionItems;

class PollingPlaceImport extends Component
{
    use WithPagination, WithSorting, WithFileUploads, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Casillas';   
    public $breadcrumb = [
        "Casillas" => "polling-places.index",  
        "Importar" => "polling-places.import",  
    ];

    public $file;
    public $file_upload_name = '';
    public $totalPollingPlacesTmp = 0;
    public $electionId;
    public $currentRouteName= '';
    public PollingPlace $pollingPlace;
    public $paginate = 10;    
    public $search = '';

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    protected $rules = [ 
        'electionId'=> ['required'],
        /*'file'=> ['required', 'mimes:xlsx,xls'],*/
        'file'=> ['required'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mountWithSorting()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }

    public function mount(PollingPlace $pollingPlace)
    {        
        PollingPlaceTmp::truncate();
        $this->currentRouteName= Route::currentRouteName();
        $this->pollingPlace= $pollingPlace;
        //$this->resetVars();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.polling-places.polling-place-import', [
            'elections' => Election::pluck('description', 'id'), 
            'items' => $this->items   
        ]);
    }

    public function resetVars()
    {
        $this->reset();
        $this->resetPage();
    }

    public function getItemsQueryProperty()
    {
        return PollingPlaceTmp::query()
            ->search(trim($this->search))
            ->with('election')
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function save()
    {
        $this->validate();
        try{          

            PollingPlaceTmp::truncate();
            $date = date('Y-m-d H:m:s');
            Excel::import(new PollingPlacesImport($this->electionId, $date), $this->file);

            $this->totalPollingPlacesTmp = DB::table('polling_place_tmps')->count();
            if (!$this->totalPollingPlacesTmp) {
                session()->flash('flashError', 'El Archivo .xls, está Vacio o los datos ya existen en la DB');
                return;
            };

            session()->flash('flashStatus', __('Revisión exitosa'));
            $this->file= null;
            $this->electionId= null;
            

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));                                   
        }
    }

    public function import()
    {
        if (!DB::table('polling_place_tmps')->count()){
            session()->flash('flashError', 'No hay información para importar');
            return;
        }

        try {
            DB::table('polling_places')->insertUsing([
                'election_id',
                'federal_district_key',
                'federal_district',
                'local_district_key',
                'local_district',
                'municipality_key',
                'municipality',
                'section',
                'section_type',
                'electoral_register',
                'nominal_electoral_register',
                'type',
                'type_key',
                'address',
                'locality',
                'location',
                'reference',
                'address_type',
            ], DB::table('polling_place_tmps')->select(
                'election_id',
                'federal_district_key',
                'federal_district',
                'local_district_key',
                'local_district',
                'municipality_key',
                'municipality',
                'section',
                'section_type',
                'electoral_register',
                'nominal_electoral_register',
                'type',
                'type_key',
                'address',
                'locality',
                'location',
                'reference',
                'address_type',
            ));
            session()->flash('flashStatus', __('Información importada correctamente'));
            $this->redirectRoute('polling-places.index');
        } catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));  
        }

    }

    public function destroy($id)
    {
        PollingPlaceTmp::find($id)->delete();
    }

    public function destroySelected(){

        foreach($this->selectedItems as $key => $idItem){
            PollingPlaceTmp::find((int)$idItem)->delete();
        }
        $this->resetPage();
    }
}
