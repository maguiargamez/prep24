<?php

namespace App\Http\Livewire\Parties;

use App\Models\PrepElection;
use App\Models\PrepPartyCoalition;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
class PartyForm extends Component
{
    use WithFileUploads;
    public $title = 'Partidos y coaliciones';   
    public $breadcrumb = [
        "Partidos y coaliciones" => "parties.index",  
    ];

    public $logo;
    public $currentRouteName= '';
    public PrepPartyCoalition $partyCoalition;
    protected $rules = [ 
        'logo'=> ['image', 'max:2048'], 
        'partyCoalition.prep_election_id'=> ['required'],
        'partyCoalition.name'=> ['required'],
        'partyCoalition.is_coalition'=> ['required'],
        'partyCoalition.is_independent'=> ['required'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount(PrepPartyCoalition $party)
    {
        
        $this->currentRouteName= Route::currentRouteName();
        $this->partyCoalition= $party;
        
        if($party->id!=null){
            $this->breadcrumb["Editar"]= 'parties.edit';            
        }else{
            $this->breadcrumb["Crear"]= 'parties.create';
        }
    }

    public function render()
    {
        return view('livewire.parties.party-form',[
            'elections' => PrepElection::pluck('description', 'id'),    
        ]);
    }

    public function save()
    {
        $this->validate();
        try{

            DB::beginTransaction();

            $this->partyCoalition->short= $this->partyCoalition->name;
            $this->partyCoalition->is_active= true;
            if($this->logo){
                $this->partyCoalition->logo= $this->logo->storePublicly('img/logos', 'public');
            }
            //dd($this->benefit->outstanding);
            $this->partyCoalition->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Registro realizado correctamente'));
            $this->redirectRoute('parties.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
