<?php

namespace Database\Seeders;

use App\Models\CCasilla;
use App\Models\PrepPartyCoalition;
use App\Models\PrepPollingPlaceRecord;
use App\Models\PrepPollingPlaceVote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrepPollingPlaceVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $pollingPlaces= CCasilla::get();
        foreach($pollingPlaces as $pollingPlace){
            //$parties= PrepPartyCoalition::where('prep_election_id', 1)->orderBy(DB::raw('RAND()'))->get();
            $parties= PrepPartyCoalition::where('prep_election_id', 1)->orderBy("id", "asc")->get();
            $nominalElectoralRegister= $pollingPlace->lista_nominal;
            $flag= rand(0,1);
            if($flag==1){
                $isCaptured=random_int(0, 1);
                $isDigitized=random_int(0, 1);
                $isValidated= 0;
                if($isCaptured==1 && $isDigitized==1){
                    $isValidated=random_int(0, 1);
                }
                
                $polling_place_record= new PrepPollingPlaceRecord();
                $polling_place_record->prep_election_id= 1;
                $polling_place_record->c_casilla_id= $pollingPlace->id;

                if($isCaptured==1){
                    $voters= rand(0, $nominalElectoralRegister);
                    $leftoverBallots= rand(0, $nominalElectoralRegister);
                    $partyRepresentativeVoters= rand(0, 10);
                    $totalVotes= $voters+$partyRepresentativeVoters;
                    $votesTakenUrn=  rand($voters, $nominalElectoralRegister);
                    $votesMatchedUrn= false;
                    if($totalVotes==$votesTakenUrn){
                        $votesMatchedUrn= true;
                    }
                    $polling_place_record->leftover_ballots= $leftoverBallots;
                    $polling_place_record->voters= $voters;
                    $polling_place_record->party_representative_voters= $partyRepresentativeVoters;
                    $polling_place_record->voters_sum= $voters+$partyRepresentativeVoters;
                    $polling_place_record->votes_taken_urn= $votesTakenUrn;
                    $polling_place_record->votes_matched_urn= $votesMatchedUrn;
                    $polling_place_record->votes_matched= false;
                }
                if($isDigitized==1){
                    $polling_place_record->digitized_record= '/actas/acta.jpeg';
                }
                $polling_place_record->is_validated= $isValidated;
                $polling_place_record->is_captured= $isCaptured;
                $polling_place_record->save();


                if($isCaptured==1){
                    foreach ($parties as $party) {

                        if($votesTakenUrn<=0){
                            $votes= 0;
                        }else{ 

                            if($party->id==1){
                                $votes= rand(300, $votesTakenUrn);
                            }else{
                                $votes= rand(0, 80);
                            }                            

                            if($votes>$votesTakenUrn){
                                $votes= rand(0, $votesTakenUrn);
                            }
                        }
                        PrepPollingPlaceVote::factory()->create([
                            'prep_election_id' => 1,
                            'prep_polling_place_record_id' => $polling_place_record->id,
                            'prep_party_coalition_id' => $party->id,
                            'votes' => $votes
                        ]);
                       
                        $votesTakenUrn-= $votes;
                    }
                }
            }

        }
    }
}
