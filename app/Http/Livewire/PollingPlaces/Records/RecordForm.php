<?php

namespace App\Http\Livewire\PollingPlaces\Records;

use App\Models\CCasilla;
use App\Models\PrepPollingPlaceRecord;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class RecordForm extends Component
{
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

    protected function rules() {
        return [  
            'prepPollingPlaceRecord.c_casilla_id'=> ['required', 'integer'],
        ];      
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
        }else{
            $this->prepPollingPlaceRecord= new PrepPollingPlaceRecord();
        }

        
    }
}
