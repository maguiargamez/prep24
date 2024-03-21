<?php

namespace App\Http\Livewire\Candidates;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\PartyCoalition;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;

class CandidateForm extends Component
{
    use WithFileUploads;
    public $title = 'Candidatos';   
    public $breadcrumb = [
        "Candidatos" => "candidates.index",  
    ];

    public $photo;
    public $currentRouteName= '';
    public Candidate $candidate;
    protected $rules = [ 
        'photo'=> ['image', 'max:2048', 'nullable'], 
        'candidate.election_id'=> ['required'],
        'candidate.party_coalition_id'=> ['required'],
        'candidate.name'=> ['required'],
        'candidate.is_active'=> [],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount(Candidate $candidate)
    {
        
        $this->currentRouteName= Route::currentRouteName();
        $this->candidate= $candidate;
        
        if($candidate->id!=null){
            $this->breadcrumb["Editar"]= 'candidates.edit';            
        }else{
            $this->breadcrumb["Crear"]= 'candidates.create';
        }
    }

    public function render()
    {
        return view('livewire.candidates.candidate-form', [
            'elections' => Election::pluck('description', 'id'),    
            'parties' => PartyCoalition::pluck('name', 'id')    
        ]);
    }

    public function save()
    {
        $this->validate();
        try{

            DB::beginTransaction();

            
            $this->candidate->is_active= true;
            if($this->photo){
                $this->candidate->photo= $this->photo->storePublicly('img/candidatos', 'public');
            }
            $this->candidate->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('candidates.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
