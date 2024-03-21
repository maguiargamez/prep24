<?php

namespace App\Http\Livewire\Records;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\Election;
use App\Models\PartyCoalition;
use App\Models\PollingPlace;
use App\Models\PollingPlaceVote;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class RecordForm extends Component
{
    use WithPagination, WithSorting, WithSelectionItems;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Captura de información';
    public $breadcrumb = [
        "Actas"=> null,
        "Captura de información" => 'records.capture.index',
    ];

    public PollingPlace $pollingPlace;
    public $currentRouteName= '';
    public $paginate = 10;    
    public $search = '';
    public $electionId=1;
    public $election= "";
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $pollingPlanceInformation= 0;
    public $partiesCoalitions= [];
    public $partiesCoalitionsValues= [];
    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    protected function rules() {

        return [  
            'pollingPlace.leftover_ballots'=> ['required', 'integer'],
            'pollingPlace.received_ballots'=> ['required', 'integer'],
            'pollingPlace.special_ballots'=> ['required', 'integer'],
            'pollingPlace.taken_ballots'=> ['required', 'integer'],
            'partiesCoalitionsValues.*'=> ['integer', 'integer'],
        ];
      
    }

    public function mount(PollingPlace $pollingPlace)
    {
        $this->currentRouteName= Route::currentRouteName();
        $this->pollingPlace= $pollingPlace;
        $this->electionId= $this->pollingPlace->election_id;
        $partiesCoalitions= PartyCoalition::select('id', 'short as name', 'logo')->where('is_active', true)->where('election_id',$this->electionId)->get();
        //dd($partiesCoalitions); 
        
        $this->partiesCoalitionsValues= PollingPlaceVote::where('polling_place_id', $this->pollingPlace->id)->pluck('votes', 'party_coalition_id');

        

        foreach($partiesCoalitions as $partyCoalition){
            array_push($this->partiesCoalitions, [
                'id'=> $partyCoalition->id,
                'name'=> $partyCoalition->name,
                'logo'=> $partyCoalition->logo,
            ]);
        }

        //dd($this->partiesCoalitions);      
    }

    public function render()
    {
        $this->election= Election::find($this->electionId);
        $this->pollingPlanceInformation= PollingPlace::select('type_key',DB::raw('concat(local_district_key, ". ", local_district) as district, concat("Sección ", section) as section2'))->where('local_district_key',$this->pollingPlace->local_district_key)->where('section',$this->pollingPlace->section)->where('type_key',$this->pollingPlace->type_key)->first();

        $this->breadcrumb['Distrito '. $this->pollingPlanceInformation->district]= ['records.district.index', $this->pollingPlace];
        $this->breadcrumb[$this->pollingPlanceInformation->section2]= ['records.section.index', $this->pollingPlace];
        $this->breadcrumb['Casilla '. $this->pollingPlanceInformation->type_key]= 'records.polling-place.create';

        return view('livewire.records.record-form');
    }

    public function resetVars()
    {
        $this->reset();
        $this->resetPage();
        //$this->resetFiltros();
    }

    public function save(){
        $this->validate();
        try{

            DB::beginTransaction();
            //dd($this->benefit->outstanding);
            $this->pollingPlace->is_captured= true;
            $this->pollingPlace->save();


            foreach($this->partiesCoalitionsValues as $key=>$value){
                //dd($value);
                 
                $pollinPlaceVotes= PollingPlaceVote::firstOrCreate(['polling_place_id' => $this->pollingPlace->id, 'party_coalition_id' => $key]);
                $pollinPlaceVotes->election_id= $this->electionId;
                $pollinPlaceVotes->polling_place_id= $this->pollingPlace->id;
                $pollinPlaceVotes->party_coalition_id= $key; 
                $pollinPlaceVotes->votes= $value; 
                $pollinPlaceVotes->save();
            }
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('records.section.index', $this->pollingPlace );

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}