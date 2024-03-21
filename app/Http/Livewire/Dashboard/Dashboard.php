<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\PollingPlace;
use App\Models\PollingPlaceVote;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Dashboard extends Component
{
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Inicio';
    public $breadcrumb = [
        "Resultados" => "dashboard.home",        
    ];

    public $currentRouteName= '';
    public $election= "";
    public $electionId=1;
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";
    public $candidates= [];
    public $totalVotes= 0;

    public function mount()
    {
        //$this->resetVars();
        $this->election= Election::find($this->electionId);
        $this->currentRouteName= Route::currentRouteName();
        $this->capturedRecords= PollingPlace::getCaptureRecords($this->electionId);
        $this->totalRecords= PollingPlace::getTotalRecords($this->electionId);
        $this->candidates= Candidate::candidatesAdvance($this->electionId);
        $this->totalVotes= PollingPlaceVote::totalVotes($this->electionId);

        if($this->totalRecords>0){
        $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }

        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }
    }


    public function render()
    {
        return view('livewire.dashboard.dashboard', [
            'elections' => Election::pluck('description', 'id'),
        ]);
    }
}
