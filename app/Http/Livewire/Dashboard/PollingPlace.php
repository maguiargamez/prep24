<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\CCasilla;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\WithPagination;
use App\Http\Traits\Dashboard\GeneralStatistics;
use App\Models\PrepCandidate;

class PollingPlace extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler, GeneralStatistics;
    public $currentRouteName= '';
    public $paginate = 10;    
    public $search = '';

    public $filterMunicipality= null;
    public $filterDistrict= null;   
    public $filterSection= null;  
    public $filterCaptureSource= null;  
    public $filterDigitilized= null;  
    public $filterIsCaptured= null;  
    public $electionId= 1;
    public $municipalityId= null; 
    public $districtId= null; 
    public $sectionId= null;


    public $municipalities= [];
    public $candidates= [];
    public $districts= [];
    public $sections;
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";
    public $sources= [1=>"PC", 2=>"App"];
    public $sourcesDigitalized= [1=>"Digitalizada", 2=>"Pendiente"];
    public $sourcesCapture= [1=>"Pendiente", 2=>"Capturada"];
    public $votesByCantidatePollingPlace= [];

    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];
    
    protected $paginationTheme = 'bootstrap';
    public $title = 'Dashboard por Casillas';
    public $breadcrumb = [
        "Dashboard"=> null,
        "Casillas" => 'dashboard.polling-places',   
    ];

    public function render()
    {

        $totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId, $this->districtId, $this->municipalityId, $this->sectionId);
        $capturedRecords= ViewPollingPlaceRecords::getCaptureRecords($this->electionId, $this->districtId, $this->municipalityId, $this->sectionId);
        if($totalRecords>0){
            $advance= number_format((($capturedRecords*100)/$totalRecords),2);
        }
        if($advance<=25){ $color="danger"; }
        if($advance>25 && $advance<=75){ $color="warning"; }

        $this->candidates= PrepCandidate::candidatesAdvance($this->electionId);

        $results= (array)DB::select("CALL get_candidates_votes_by_general(?,?,?,?)", [$this->electionId, $this->municipalityId, $this->districtId, $this->sectionId]);


        if(count($results)>0){            
            $votosCandidatos= (array)$results[0];

        }else{
            $array["prep_election_id"]= $this->electionId;
            $array["total"]= 0;
            foreach($this->candidates as $candidate){
                $array[$candidate->name_replaced]= 0;
            }
            $votosCandidatos= $array;
        } 

        $this->votesByCantidatePollingPlace= $this->createVotesArray();


        return view('livewire.dashboard.polling-place', [
            'items' => $this->items,
            'totalRecords'=> $totalRecords,
            'capturedRecords'=> $capturedRecords,
            'advance'=> $advance,
            'color'=> $color,
            'candidates'=> $this->candidates,
            'votosCandidatos'=> $votosCandidatos,
            
        ]);
    }

    public function resetVars()
    {
        $this->reset();
        $this->resetPage();
    }

    public function mountWithSorting()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }

    public function updatedFilterMunicipality()
    {
        $this->districts= CCasilla::getDistrictsComboRoman($this->filterMunicipality);
        $this->sections= CCasilla::getSectionsCombo($this->filterMunicipality);
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
        
    }

    public function updatedFilterDistrict()
    {
        $this->sections= CCasilla::getSectionsCombo($this->filterMunicipality, $this->filterDistrict);
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
        
    }

    public function updatedFilterSection()
    {
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
        
    }


    public function mount()
    {
        $this->resetVars();
        $this->currentRouteName= Route::currentRouteName();

        $this->totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId);
        $this->capturedRecords= ViewPollingPlaceRecords::getCaptureRecords($this->electionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

        $this->municipalities= CCasilla::getMunicipalitiesCombo();
        $this->districts= CCasilla::getDistrictsComboRoman($this->filterMunicipality);
        $this->sections= CCasilla::getSectionsCombo($this->filterMunicipality, $this->filterDistrict);

        $this->getFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);        

        
        //dd($this->votesByCantidatePollingPlace);
    }

    public function updatedPaginate()
    {  
           
        $this->resetPage();        
    }

    public function filter()
    {
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->filterMunicipality= null;
        $this->filterDistrict= null;
        $this->filterSection= null;
        $this->filterCaptureSource= null;
        $this->filterDigitilized= null;
        $this->filterIsCaptured= null;
        $this->clearFilters($this->currentRouteName);
        
    }

    public function updatingSearch()
    {
        $this->resetPage();
        
    }

    public function getItemsQueryProperty()
    {
        return ViewPollingPlaceRecords::
            select('*')
            ->search(trim($this->search))
            ->filterMunicipality($this->filterMunicipality)
            ->filterDistrict($this->filterDistrict)
            ->filterSection($this->filterSection)
            ->filterCaptureSource($this->filterCaptureSource)
            ->filterDigitilized($this->filterDigitilized)
            ->filterIsCaptured($this->filterIsCaptured)
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function downloadFile($file){
        
        return response()->download(storage_path('app/'.$file));
    }

    public function getStatistics(){
        $this->setValuesGeneralStatistic(); 
    }

    public function createVotesArray(){
        $votesByCantidatePollingPlace= (array)DB::select("CALL get_candidates_votes_by_casillas_id(?, ?, ?, ?)", [$this->electionId, null,null, null]);       

        $arrayVotes= [];

        foreach($votesByCantidatePollingPlace as $value){

            //dd($value->id);
            $arrayCandidates= [];
            $total= 0;
            foreach($this->candidates as $candidate){
                $arrayCandidates[$candidate->name_replaced]= $value->{$candidate->name_replaced};  
                $total+=  $value->{$candidate->name_replaced};             
            }
            $arrayCandidates["total"]= $total;
            $arrayVotes[$value->id]= $arrayCandidates;
        }

        return $arrayVotes;
    }
}
