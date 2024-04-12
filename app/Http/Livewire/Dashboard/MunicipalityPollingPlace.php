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

class MunicipalityPollingPlace extends Component
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
    public $advanceTitle= "";
    public $votosCandidatos= [];
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";

    protected $paginationTheme = 'bootstrap';
    public $title = 'Dashboard por Municipios';
    public $breadcrumb = [
        "Dashboard"=> null,
        "Municipio" => 'dashboard.municipality', 
        "Secciones" => 'dashboard.municipality.section',
    ];

    protected $listeners = [
        'refresh-data' => '$refresh'
    ];

    public function mount($municipalityId,$sectionId)
    {
        $this->sectionId= $sectionId;
        $this->municipalityId= $municipalityId;

        $this->municipality= CMunicipio::find($this->municipalityId)->municipio;

        $this->advanceTitle= $this->municipality.". Sección ".$sectionId;
        $this->breadcrumb["Secciones"]= ["dashboard.municipality.section", $this->municipalityId];        
        $this->breadcrumb["Casillas"]= "dashboard.municipality.section.polling-place";        
        $this->currentRouteName= Route::currentRouteName();
        $this->setValuesGeneralStatistic();  
    }

    public function render()
    {
        return view('livewire.dashboard.municipality-polling-place',[
            'votosCandidatosCasillas' => $this->items,
            'sections'=> CCasilla::getSectionsCombo($this->municipalityId)
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();        
    }

    public function updatedSectionId()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        $this->municipality= CMunicipio::find($this->municipalityId)->municipio;
        $this->advanceTitle= $this->municipality." - Sección ".$this->sectionId;
        
    }

    public function getItemsProperty()
    {
        return (array)DB::select("CALL get_candidates_votes_by_casillas(?, ?, ?, ?)", [$this->electionId, $this->municipalityId, null, $this->sectionId]);
    }


    public function downloadFile($file){
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        $this->municipality= CMunicipio::find($this->municipalityId)->municipio;
        $this->advanceTitle= $this->municipality." - Sección ".$this->sectionId;
        return response()->download(storage_path('app/'.$file));
    }
}
