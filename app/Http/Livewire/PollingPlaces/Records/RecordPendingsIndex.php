<?php

namespace App\Http\Livewire\PollingPlaces\Records;

use Livewire\Component;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\CCasilla;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\WithPagination;

class RecordPendingsIndex extends Component
{
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
    public $municipalities= [];
    public $districts= [];
    public $sections;
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";
    public $sources= [1=>"PC", 2=>"App"];
    public $sourcesDigitalized= [1=>"Digitalizada", 2=>"Pendiente"];
    public $sourcesCapture= [1=>"Pendiente", 2=>"Capturada"];


    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    use WithPagination, WithSorting, WithSelectionItems, SessionHandler;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Casillas';
    public $breadcrumb = [
        "Captura de información"=> null,
        "Captura pendiente" => 'records.polling-places-pendings.index',   
    ];

    public function render()
    {
        return view('livewire.polling-places.records.record-pendings-index', [
            'items' => $this->items
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

    public function updatedFilterCaptureSource()
    {
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
    }

    public function updatedFilterDigitilized()
    {
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
    }

    public function updatedFilterIsCaptured()
    {

        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
    }

    public function mount()
    {
        $this->resetVars();
        $this->currentRouteName= Route::currentRouteName();

        $this->totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId);
        $this->capturedRecords= ViewPollingPlaceRecords::getPendingdsRecords($this->electionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

        $this->municipalities= CCasilla::getMunicipalitiesCombo();
        $this->districts= CCasilla::getDistrictsComboRoman($this->filterMunicipality);
        $this->sections= CCasilla::getSectionsCombo($this->filterMunicipality, $this->filterDistrict);

        $this->getFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
             
    }

    public function updatingPaginate()
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
            ->where("is_captured", 0)
            ->search(trim($this->search))
            ->filterMunicipality($this->filterMunicipality)
            ->filterDistrict($this->filterDistrict)
            ->filterSection($this->filterSection)
            ->filterCaptureSource($this->filterCaptureSource)
            ->filterDigitilized($this->filterDigitilized)
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function downloadFile($file){
        return response()->download(public_path($file));
    }

}
