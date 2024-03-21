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

class RecordCaptures extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Captura de información';
    public $breadcrumb = [
        "Actas"=> null,
        "Captura de información" => 'records.capture.index',   
    ];

    public $currentRouteName= '';
    public $paginate = 50;    
    public $search = '';
    public $electionId=1;
    public $election= "";
    public $capturedRecords= 0;
    public $totalRecords= 0;
    

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    public function updatedElectionId()
    {
        //$this->resetExcept('electionId');
        //$this->loadData();
        $this->resetPage();
    }

    public function render()
    {
        
        $this->election= Election::find($this->electionId);
        $this->capturedRecords= PollingPlace::getCaptureRecords($this->electionId);
        $this->totalRecords= PollingPlace::getTotalRecords($this->electionId);

        return view('livewire.records.captures.record-captures', [
            'items' => $this->items,
            'elections' => Election::pluck('description', 'id'),
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
        $this->sortBy = 'local_district_key';
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
        return PollingPlace::select(
            'id',
            'local_district_key',
            DB::raw('concat(local_district_key, ".- ", local_district) as district'),
            DB::raw('count(IF(is_captured = 1, 1, NULL)) as captured'),
            DB::raw('count(digitized_record) as total_actas'),
            DB::raw('count(*) as total'),
            )
            ->searchDistrict(trim($this->search))
            ->where('election_id', $this->electionId)
            ->groupBy('local_district_key')
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
