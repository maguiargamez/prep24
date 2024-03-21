<?php

namespace App\Http\Livewire\Elections;

use App\Models\Election;
use App\Models\ElectionType;
use App\Models\Municipality;
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
    public Election $election;
    /*protected $rules = [  
        'election.election_type_id'=> ['required'],
        'election.state_id'=> ['required'],
        'election.municipality_id'=> [],
        'election.description'=> ['required'],
    ];*/

    protected function rules() {

        if($this->election->election_type_id==1){
            return [  
                'election.election_type_id'=> ['required'],
                'election.state_id'=> ['required'],
                'election.municipality_id'=> [],
                'election.description'=> ['required'],
            ];
        }else{
            return [  
                'election.election_type_id'=> ['required'],
                'election.state_id'=> ['required'],
                'election.municipality_id'=> ['required'],
                'election.description'=> ['required'],
            ];
        }
      
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedElectionStateId()
    {
        $this->municipalities= Municipality::where('state_id', $this->election->state_id)->pluck('name', 'id');
        //dd($this->municipalities);
    }


    public function mount(Election $election)
    {
        
        $this->currentRouteName= Route::currentRouteName();
        $this->election= $election;
        
        if($election->id!=null){
            $this->breadcrumb["Editar"]= 'elections.edit';
            if($this->election->election_type_id==2){
                $this->municipalities= Municipality::where('state_id', $this->election->state_id)->pluck('name', 'id');
            }
        }else{
            $this->election->outstanding=1;
            $this->breadcrumb["Crear"]= 'elections.create';
        }
    }

    public function render()
    {
        return view('livewire.elections.election-form',[
            'electionTypes' => ElectionType::pluck('description', 'id'),
            'states' => State::pluck('name', 'id'),
        ]);
    }

    public function save()
    {
        $this->validate();
        try{

            DB::beginTransaction();


            //dd($this->benefit->outstanding);
            $this->election->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('elections.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
