<?php

namespace App\Http\Livewire\Elections;

use App\Models\Election;
use App\Models\ElectionType;
use App\Models\Municipality;
use App\Models\PrepElection;
use App\Models\PrepElectionType;
use App\Models\State;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ElectionForm extends Component
{
    public $title = 'Elecciones';   
    public $breadcrumb = [
        "Elecciones" => "elections.index",  
    ];

    public $municipalities;
    public $currentRouteName= '';
    public PrepElection $prepElection;
    /*protected $rules = [  
        'election.election_type_id'=> ['required'],
        'election.state_id'=> ['required'],
        'election.municipality_id'=> [],
        'election.description'=> ['required'],
    ];*/

    protected function rules() {
        /*if($this->election->election_type_id==1){
            return [  
                'prepElection.election_type_id'=> ['required'],
                'prepElection.state_id'=> ['required'],
                'prepElection.municipality_id'=> [],
                'prepElection.description'=> ['required'],
            ];
        }else{
            return [  
                'prepElection.election_type_id'=> ['required'],
                'prepElection.state_id'=> ['required'],
                'prepElection.municipality_id'=> ['required'],
                'prepElection.description'=> ['required'],
            ];
        }*/
        return [  
            'prepElection.prep_election_type_id'=> ['required'],
            'prepElection.description'=> ['required'],
        ]; 
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedElectionStateId()
    {
        //$this->municipalities= Municipality::where('state_id', $this->election->state_id)->pluck('name', 'id');
        //dd($this->municipalities);
    }

    public function mount(PrepElection $election)
    {
        
        $this->currentRouteName= Route::currentRouteName();
        $this->prepElection= $election;
        
        if($election->id!=null){
            $this->breadcrumb["Editar"]= 'elections.edit';
            /*if($this->election->election_type_id==2){
                $this->municipalities= Municipality::where('state_id', $this->election->state_id)->pluck('name', 'id');
            }*/
        }else{
            
            $this->breadcrumb["Crear"]= 'elections.create';
        }
    }

    public function render()
    {
        return view('livewire.elections.election-form',[
            'electionTypes' => PrepElectionType::pluck('description', 'id'),
            /*'states' => State::pluck('name', 'id'),*/
        ]);
    }

    public function save()
    {
        $this->validate();
        try{
            DB::beginTransaction();
            //dd($this->benefit->outstanding);
            $this->prepElection->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('elections.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
