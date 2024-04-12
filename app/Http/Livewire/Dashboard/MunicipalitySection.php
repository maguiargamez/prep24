<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Traits\Dashboard\GeneralStatistics;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSelectionItems;
use App\Models\CCasilla;
use App\Models\CMunicipio;
use App\Models\PrepCandidate;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MunicipalitySection extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler, GeneralStatistics;

    public $currentRouteName= '';    
    public $paginate = 10;    
    public $search = null;
    public $electionId= 1;
    public $municipalityId= null; 
    public $municipality= null; 
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

    public function mount($id)
    {
        $this->municipalityId= $id;
        $this->municipality= CMunicipio::find($id)->municipio;
        //$this->breadcrumb[$this->municipality."- Secciones"]= "dashboard.municipality.section";        
        $this->breadcrumb["Secciones"]= "dashboard.municipality.section";        
        $this->currentRouteName= Route::currentRouteName();
        $this->setValuesGeneralStatistic();  
    }

    public function render()
    {
        return view('livewire.dashboard.municipality-section',[
            'votosCandidatosSecciones' => $this->items,
            'municipalities'=> CCasilla::getMunicipalitiesCombo()
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        
    }

    public function updatedMunicipalityId()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        $this->municipality= CMunicipio::find($this->municipalityId)->municipio;
        
    }

    public function getItemsProperty()
    {
        return (array)DB::select("CALL get_candidates_votes_by_seccion(?, ?, ?, ?)", [$this->electionId, $this->municipalityId, null, $this->search]);
    }
}
