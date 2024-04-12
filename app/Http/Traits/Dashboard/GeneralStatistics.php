<?php

namespace App\Http\Traits\Dashboard;

use App\Models\PrepCandidate;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;

trait GeneralStatistics
{

    public function setValuesGeneralStatistic()
    {
        $this->totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId, $this->districtId, $this->municipalityId, $this->sectionId);
        
        $this->capturedRecords= ViewPollingPlaceRecords::getCaptureRecords($this->electionId, $this->districtId, $this->municipalityId, $this->sectionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

        $this->candidates= PrepCandidate::candidatesAdvance($this->electionId);

        $results= (array)DB::select("CALL get_candidates_votes_by_general(?,?,?,?)", [$this->electionId, $this->municipalityId, $this->districtId, $this->sectionId]);

        

        if(count($results)>0){
            
            $this->votosCandidatos= (array)$results[0];
            //dd($this->votosCandidatos); 

        }else{
            $array["prep_election_id"]= $this->electionId;
            $array["total"]= 0;
            foreach($this->candidates as $candidate){
                $array[$candidate->name_replaced]= 0;
            }
            $this->votosCandidatos= $array;
        }
        

        
    }

}