<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Traits\Dashboard\GeneralStatistics;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSelectionItems;
use App\Models\PrepCandidate;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Municipality extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler, GeneralStatistics;

    public $currentRouteName= '';    
    public $paginate = 10;    
    public $search = null;
    public $electionId= 1;
    public $municipalityId= null; 
    public $districtId= null; 
    public $sectionId= null;
    public $candidates= [];
    public $votosCandidatos= [];
    //public $votosCandidatosMunicipios= [];
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";

    protected $paginationTheme = 'bootstrap';
    public $title = 'Dashboard por Municipios';
    public $breadcrumb = [
        "Dashboard"=> null,
        "Municipio" => 'dashboard.municipality',   
    ];

    protected $listeners = [
        'refresh-data' => '$refresh'
    ];

    public function mount()
    {
        //$this->resetVars();
        $this->currentRouteName= Route::currentRouteName();

        $this->setValuesGeneralStatistic();
        //$this->votosCandidatosMunicipios = (array)DB::select("CALL get_candidates_votes_by_municipio(?, ?)", [$this->electionId, null]);

        //dd($this->votosCandidatosMunicipios);
        //$this->getFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
             
    }

    public function render()
    {
        //dd($this->items);
        return view('livewire.dashboard.municipality',[
            'votosCandidatosMunicipios' => $this->items
        ]);
    }

    public function updatedSearch()
    {
        //dd($this->search);
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        //dd($this->items);
        
    }

    public function getItemsProperty()
    {
        return (array)DB::select("CALL get_candidates_votes_by_municipio(?, ?)", [$this->electionId, $this->search]);
    }
}
