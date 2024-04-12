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

class DistrictSection extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler, GeneralStatistics;

    public $currentRouteName= '';    
    public $paginate = 10;    
    public $search = null;
    public $electionId= 1;
    public $municipalityId= null; 
    public $district= null; 
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
    public $title = 'Dashboard por Distrito';
    public $breadcrumb = [
        "Dashboard"=> null,
        "Distrito" => 'dashboard.district', 
    ];

    protected $listeners = [
        'refresh-data' => '$refresh'
    ];

    public function mount($id)
    {
        $this->districtId= $id;
        $this->district= "Distrito ".$id;        
        $this->breadcrumb["Secciones"]= "dashboard.district.section";        
        $this->currentRouteName= Route::currentRouteName();
        $this->setValuesGeneralStatistic();  
    }

    public function render()
    {
        return view('livewire.dashboard.district-section', [
            'votosCandidatosSecciones' => $this->items,
            'districts'=> CCasilla::getDistrictsComboRoman()
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        
    }

    public function updatedDistrictId()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
        $this->district= "Distrito ".$this->districtId;        
    }

    public function getItemsProperty()
    {
        return (array)DB::select("CALL get_candidates_votes_by_seccion(?, ?, ?, ?)", [$this->electionId, null, $this->districtId, $this->search]);
    }
}
