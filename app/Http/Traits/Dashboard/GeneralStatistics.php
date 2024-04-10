<?php

namespace App\Http\Traits\Dashboard;

use App\Models\PrepCandidate;
use App\Models\ViewPollingPlaceRecords;
use Illuminate\Support\Facades\DB;

trait GeneralStatistics
{

    public function setValuesGeneralStatistic()
    {
        $this->totalRecords= ViewPollingPlaceRecords::getTotalRecords($this->electionId);
        $this->capturedRecords= ViewPollingPlaceRecords::getCaptureRecords($this->electionId);

        if($this->totalRecords>0){
            $this->advance= number_format((($this->capturedRecords*100)/$this->totalRecords),2);
        }
        if($this->advance<=25){ $this->color="danger"; }
        if($this->advance>25 && $this->advance<=75){ $this->color="warning"; }

        $this->votosCandidatos = (array)DB::select("CALL get_candidates_votes_by_general(?,?,?,?)", [$this->electionId, $this->municipalityId, $this->districtId, $this->sectionId])[0];        
        $this->candidates= PrepCandidate::candidatesAdvance($this->electionId);
    }

}