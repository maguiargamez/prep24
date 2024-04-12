<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSelectionItems;
use App\Models\PrepCandidate;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Traits\Dashboard\GeneralStatistics;

class General extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler, GeneralStatistics;

    public $currentRouteName= '';    
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;
    public $municipalityId= null; 
    public $districtId= null; 
    public $sectionId= null;

    public $candidates= [];
    public $votosCandidatos= [];
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";

    protected $paginationTheme = 'bootstrap';
    public $title = 'Dashboard por Entidad';
    public $breadcrumb = [
        "Dashboard"=> null,
        "General" => 'dashboard.entity',   
    ];

    public function mount()
    {
        //$this->resetVars();
        $this->currentRouteName= Route::currentRouteName();

        $this->setValuesGeneralStatistic();

        //dd($this->votosCandidatos);
        //$this->getFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
             
    }

 

    public function render()
    {
        return view('livewire.dashboard.general');
    }
}
