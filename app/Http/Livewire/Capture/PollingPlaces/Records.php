<?php

namespace App\Http\Livewire\Capture\PollingPlaces;

use Livewire\Component;
use App\Http\Traits\SessionHandler;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithSelectionItems;
use App\Models\PollingPlace;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class Records extends Component
{
    use WithPagination, WithSorting, WithSelectionItems, SessionHandler;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Casillas';
    public $breadcrumb = [
        "Captura de información"=> null,
        "Casillas" => 'capture.polling-places.index',   
    ];

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
    public $sections= [];
    public $capturedRecords= 0;
    public $totalRecords= 0;
    public $advance= 0;
    public $color="success";
    public $sources= [1=>"PC", 2=>"App"];
    public $sourcesDigitalized= [1=>"Digitalizada", 2=>"Pendiente"];
    public $sourcesCapture= [1=>"Capturada", 0=>"Pendiente"];


    protected $listeners = [
        'refresh-data' => '$refresh',
        'destroy',
        'destroySelected'
    ];

    public function render()
    {
        $this->municipalities= PollingPlace::getMunicipalitiesCombo($this->electionId);        
        $this->districts= PollingPlace::getDistrictsComboRoman($this->electionId, $this->filterMunicipality);
        $this->sections= PollingPlace::getSectionsCombo($this->electionId, $this->filterMunicipality, $this->filterDistrict);
        return view('livewire.capture.polling-places.records', [
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
        $this->districts= PollingPlace::getDistrictsComboRoman($this->electionId, $this->filterMunicipality);
        $this->sections= PollingPlace::getSectionsCombo($this->electionId, $this->filterMunicipality);
        $this->setFilters($this->currentRouteName, ['filterMunicipality', 'filterDistrict', 'filterSection', 'filterCaptureSource', 'filterDigitilized', 'filterIsCaptured']);
    }

    public function updatedFilterDistrict()
    {
        $this->sections= PollingPlace::getSectionsCombo($this->electionId, $this->filterMunicipality, $this->filterDistrict);
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

        $this->totalRecords= PollingPlace::getTotalRecords($this->electionId);
        $this->capturedRecords= PollingPlace::getCaptureRecords($this->electionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

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
        return PollingPlace::
            select(
            'id',
            'is_captured',
            'capture_source',
            'municipality_key',
            'municipality',
            DB::raw('concat("Distrito  ", local_district_key) as district'),
            'local_district_key',
            'local_district',
            'section',
            'section_type',
            'type',
            'type_key',
            'digitized_record',
            'is_captured',
            'is_validated',
            'updated_at',
            )
            ->with('election')
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
        return response()->download(public_path($file));
    }
}
