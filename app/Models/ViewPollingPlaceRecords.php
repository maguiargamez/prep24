<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ViewPollingPlaceRecords extends Model
{
    use HasFactory;
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('section', 'like', '%'.$term.'%')
                ->orWhere('municipality', 'like', '%'.$term.'%')
                ->orWhere(DB::raw('concat("Distrito ", local_district_key)'), 'like', '%'.$term.'%')
                ->orWhere('type', 'like', '%'.$term.'%')
                ->orWhere('type_key', 'like', '%'.$term.'%')
                ;
        });
    }

    public function scopeSearchDistrict($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('local_district_key', 'like', '%'.$term.'%');
        });
    }

    public function scopeSearchSection($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('type_key', 'like', '%'.$term.'%');
        });
    }

    public function scopeFilterMunicipality($query, $term)
    {
        if($term){
            $query->where("municipality_key", $term);
        }        
    }

    public function scopeFilterDistrict($query, $term)
    {
        if($term){
            $query->where(DB::raw("CAST(local_district_key AS UNSIGNED)"), $term);
        }        
    }

    public function scopeFilterSection($query, $term)
    {
        if($term){
            $query->where(DB::raw("CAST(section AS UNSIGNED)"), $term);
        }        
    }

    public function scopeFilterCaptureSource($query, $term)
    {
        if($term){
            $query->where("is_captured", 1)
            ->where("capture_source", $term);
        }        
    }

    public function scopeFilterDigitilized($query, $term)
    {
        if($term){
            if($term==1){
                $query->whereNotNull("digitized_record");
            }else{
                $query->whereNull("digitized_record");
            }
            
        }        
    }

    public function scopeFilterIsCaptured($query, $term)
    {     
           
        if($term==1){            
            $query->where("is_captured", 0);           
        }elseif($term==2){
            $query->where("is_captured", 1); 
        }  
    }

    public function getRecords(){
        $query= ViewPollingPlaceRecords::select('federal_district_key', 'federal_district', 'local_district_key', 'local_district', 'section', 'type_key', 'digitized_record','observations')->groupBy('local_district_key');
    }

    public static function getCaptureRecords($electionId=null, $localDistrictKey=null, $municipalityKey=null, $section= null){
        $query= ViewPollingPlaceRecords::select('*');

        if($localDistrictKey){
            $query= $query->where('local_district_key', $localDistrictKey);
        }   
        
        if($municipalityKey){
            $query= $query->where('municipality_key', $municipalityKey);
        }  

        if($section){
            $query= $query->where(DB::raw('CONVERT(section,UNSIGNED INTEGER)'), $section);
        }
        
        $query= $query->where('is_captured', true)->count();
        return $query;
    }

    public static function getPendingdsRecords($electionId=null){
        $query= ViewPollingPlaceRecords::where('is_captured', false)->count();
        return $query;
    }

    public static function getTotalRecords($electionId=null, $localDistrictKey=null, $municipalityKey=null, $section= null){
        $query= ViewPollingPlaceRecords::select('*');

        if($localDistrictKey){
            $query= $query->where('local_district_key', $localDistrictKey);
        }   
        
        if($municipalityKey){
            
            $query= $query->where('municipality_key', $municipalityKey);
        }  

        if($section){
            //$query= $query->where('section', $section);
            $query= $query->where(DB::raw('CONVERT(section,UNSIGNED INTEGER)'), $section);
        }  

        //dd($query);
        
        $query= $query->count();

        return $query;
    }

    public static function getTotalPendingsRecords($electionId=null){
        $query= ViewPollingPlaceRecords::count();
        return $query;
    }

    

}
