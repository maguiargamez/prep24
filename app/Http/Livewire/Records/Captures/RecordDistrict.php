<?php

namespace App\Http\Livewire\Records\Captures;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\Election;
use App\Models\PollingPlace;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class RecordDistrict extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Captura de información';
    public $breadcrumb = [
        "Actas"=> null,
        "Captura de información" => 'records.capture.index',
    ];

    public PollingPlace $pollingPlace;
    public $currentRouteName= '';
    public $paginate = 10;    
    public $search = '';
    public $electionId=1;
    public $election= "";
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $district= 0;
    public $section= 0;

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    public function mount(PollingPlace $pollingPlace)
    {
        $this->currentRouteName= Route::currentRouteName();
        $this->pollingPlace= $pollingPlace;
        $this->electionId= $this->pollingPlace->election_id;        
    }

    public function render()
    {
        $this->election= Election::find($this->electionId);
        $this->district= PollingPlace::select(DB::raw('concat(local_district_key, ". ", local_district) as name'))->where('local_district_key',$this->pollingPlace->local_district_key)->first();
        //$this->section= PollingPlace::select(DB::raw('concat("Sección ", section) as name'))->where('local_district_key',$this->pollingPlace->local_district_key)->where('section',$this->pollingPlace->section)->first();

        $this->breadcrumb['Distrito '. $this->district->name]= 'records.district.index';
        //$this->breadcrumb['Sección '. $this->section->name]= null;
        
        $this->capturedRecords= PollingPlace::where('election_id', $this->electionId)->where('local_district_key',$this->pollingPlace->local_district_key)->where('is_captured', true)->count();
        $this->totalRecords= PollingPlace::where('election_id', $this->electionId)->where('local_district_key',$this->pollingPlace->local_district_key)->count();

        return view('livewire.records.captures.record-district', [
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
        $this->sortBy = 'section';
        $this->sortDirection = 'asc';
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
        return PollingPlace::select(
            'id',
            DB::raw('concat("Sección ", section) as section2'),
            DB::raw('count(IF(is_captured = 1, 1, NULL)) as captured'),
            DB::raw('count(*) as total'),
            'section'
            )
            ->search(trim($this->search))
            ->where('local_district_key',$this->pollingPlace->local_district_key)
            ->groupBy('section')
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function destroy($id)
    {
        PollingPlace::find($id)->delete();
    }

    public function destroySelected(){

        foreach($this->selectedItems as $key => $idItem){
            PollingPlace::find((int)$idItem)->delete();
        }
        $this->resetPage();
    }
}
