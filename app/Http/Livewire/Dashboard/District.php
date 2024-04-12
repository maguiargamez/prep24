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

class District extends Component
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
    public $title = 'Dashboard por Distrito';
    public $breadcrumb = [
        "Dashboard"=> null,
        "Distrito" => 'dashboard.district',   
    ];

    protected $listeners = [
        'refresh-data' => '$refresh'
    ];

    public function mount()
    {
        $this->currentRouteName= Route::currentRouteName();
        $this->setValuesGeneralStatistic();         
    }

    public function render()
    {
        return view('livewire.dashboard.district', [
            'votosCandidatosMunicipios' => $this->items
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->setValuesGeneralStatistic();
    }

    public function getItemsProperty()
    {
        return (array)DB::select("CALL get_candidates_votes_by_distrito(?, ?, ?)", [$this->electionId, null, $this->search]);
    }
}
