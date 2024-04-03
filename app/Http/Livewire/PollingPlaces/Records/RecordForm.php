<?php

namespace App\Http\Livewire\PollingPlaces\Records;

use App\Models\CCasilla;
use App\Models\PrepPartyCoalition;
use App\Models\PrepPollingPlaceRecord;
use App\Models\PrepPollingPlaceVote;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class RecordForm extends Component
{
    use WithFileUploads;

    public $currentRouteName= '';
    protected $paginationTheme = 'bootstrap';
    public $title = 'Casillas';
    public $breadcrumb = [
        "Captura de información"=> null,
        "Casillas" => 'records.polling-places.index',   
        "Acta" => 'records.polling-places.record.index',   
    ];    

    public CCasilla $cCasilla;
    public PrepPollingPlaceRecord $prepPollingPlaceRecord;
    public $partiesCoalitions= [];
    public $partiesCoalitionsValues= [];
    public $digitizedRecordSize= null;
    public $digitizedRecord;

    protected function rules() {
        return [              
            'prepPollingPlaceRecord.leftover_ballots'=> ['required', 'integer'],
            'prepPollingPlaceRecord.voters'=> ['required', 'integer'],
            'prepPollingPlaceRecord.party_representative_voters'=> ['required', 'integer'],            
            'prepPollingPlaceRecord.voters_sum'=> ['required', 'integer'],
            'prepPollingPlaceRecord.votes_taken_urn'=> ['required', 'integer'],            
            'prepPollingPlaceRecord.votes_matched_urn'=> ['required', 'integer'],
            'digitizedRecord'=> [                
                'nullable',
                Rule::when($this->digitizedRecord, ['mimes:jpg,jpeg,png,pdf'])
            ],
            'prepPollingPlaceRecord.is_captured'=> ['nullable'],
            'prepPollingPlaceRecord.is_validated'=> ['nullable'],
            'prepPollingPlaceRecord.capture_source'=> ['nullable'],
        ];      
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.polling-places.records.record-form');
    }

    public function mount(CCasilla $cCasilla)
    {
        $this->currentRouteName= Route::currentRouteName();
        $this->cCasilla= $cCasilla;

        $prepPollingPlaceRecord= PrepPollingPlaceRecord::where('c_casilla_id', $this->cCasilla->id)->orderBy('id', 'desc')->first();
        if($prepPollingPlaceRecord){
            $this->prepPollingPlaceRecord= $prepPollingPlaceRecord;
            $this->partiesCoalitionsValues= PrepPollingPlaceVote::where('prep_polling_place_record_id', $this->prepPollingPlaceRecord->id)->pluck('votes', 'prep_party_coalition_id');
            if($this->prepPollingPlaceRecord->digitized_record){
                $this->digitizedRecordSize= $this->getFileSize($this->prepPollingPlaceRecord->digitized_record);
            }
        }else{
            $this->prepPollingPlaceRecord= new PrepPollingPlaceRecord();
        }

        $partiesCoalitions= PrepPartyCoalition::select('id', 'short as name', 'logo')->where('is_active', true)->get();        
        foreach($partiesCoalitions as $partyCoalition){
            array_push($this->partiesCoalitions, [
                'id'=> $partyCoalition->id,
                'name'=> $partyCoalition->name,
                'logo'=> $partyCoalition->logo,
            ]);
        }

        
    }

    public function updatedPrepPollingPlaceRecordVoters()
    {
        $this->checkFields();
    }

    public function updatedPrepPollingPlaceRecordPartyRepresentativeVoters()
    {
        $this->checkFields();
    }

    public function updatedPrepPollingPlaceRecordVotesTakenUrn()
    {
        $this->checkFields();
    }

    private function checkFields(){
        if(is_numeric($this->prepPollingPlaceRecord->voters) && is_numeric($this->prepPollingPlaceRecord->party_representative_voters)){
            $this->prepPollingPlaceRecord->voters_sum= $this->prepPollingPlaceRecord->voters + $this->prepPollingPlaceRecord->party_representative_voters;
        }

        if($this->prepPollingPlaceRecord->votes_taken_urn == $this->prepPollingPlaceRecord->voters_sum){
            $this->prepPollingPlaceRecord->votes_matched_urn= 1;
        }else{
            $this->prepPollingPlaceRecord->votes_matched_urn= 0;
        }
    }

    public function save(){
        $this->validate();
        try{
            DB::beginTransaction();
            $this->prepPollingPlaceRecord->prep_election_id= 1; 
            $this->prepPollingPlaceRecord->c_casilla_id= $this->cCasilla->id; 
            $this->prepPollingPlaceRecord->votes_matched= 2; 

            $this->prepPollingPlaceRecord->is_captured= true;
            $this->prepPollingPlaceRecord->is_validated= false;
            if($this->digitizedRecord){
                $this->prepPollingPlaceRecord->digitized_record= $this->digitizedRecord->store('actas');
                //dd($this->prepPollingPlaceRecord->digitized_record);
            }
            $this->prepPollingPlaceRecord->capture_source= 1; 
            $this->prepPollingPlaceRecord->save();


            foreach($this->partiesCoalitionsValues as $key=>$value){                 
                $pollinPlaceVotes= PrepPollingPlaceVote::firstOrCreate(['prep_election_id' => 1, 'prep_polling_place_record_id' => $this->prepPollingPlaceRecord->id, 'prep_party_coalition_id' => $key]);
                //dd($pollinPlaceVotes);
                $pollinPlaceVotes->prep_election_id= 1;
                $pollinPlaceVotes->prep_polling_place_record_id= $this->prepPollingPlaceRecord->id;
                $pollinPlaceVotes->prep_party_coalition_id= $key; 
                $pollinPlaceVotes->votes= $value;
                $pollinPlaceVotes->save();
            }
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('records.polling-places.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            //ddd($e->getMessage());
            DB::rollback();                       
        }
    }

    public function downloadFile($file){
        return response()->download(storage_path('app/'.$file));
    }

    public function getFileSize($file){
        //dd($file);
        return number_format(Storage::size($file)/1024,1);
    }
}
