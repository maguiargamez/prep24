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

class General extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler;

    public $currentRouteName= '';    
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;
    public $candidates= [];
    public $votosCandidatos= [];
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";

    protected $paginationTheme = 'bootstrap';
    public $title = 'Casillas';
    public $breadcrumb = [
        "Dashboard"=> null,
        "General" => 'dashboard.entity',   
    ];

    public function mount()
    {
        //$this->resetVars();
        $this->currentRouteName= Route::currentRouteName();

        $this->totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId);
        $this->capturedRecords= ViewPollingPlaceRecords::getCaptureRecords($this->electionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

        $this->votosCandidatos = (array)DB::select("CALL get_candidates_votes_by_general(?)", [$this->electionId])[0];
        $this->candidates= PrepCandidate::candidatesAdvance($this->electionId);

        //dd($this->votosCandidatos);


        //$this->getFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
             
    }

 

    public function render()
    {
        return view('livewire.dashboard.general');
    }
}
