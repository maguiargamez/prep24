<?php

namespace Database\Seeders;

use App\Models\PartyCoalition;
use App\Models\PollingPlace;
use App\Models\PollingPlaceVote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollingPlaceVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties= PartyCoalition::where('election_id', 1)->get();
        $pollingPlaces= PollingPlace::where('election_id', 1)->get();

        foreach($pollingPlaces as $pollingPlace){

            $nominalElectoralRegister= $pollingPlace->nominal_electoral_register;

            foreach ($parties as $party) {

                if($nominalElectoralRegister<=0){
                    $votes= 0;
                }else{
                    
                    $votes= rand(0, 80);
                    if($votes>$nominalElectoralRegister){
                        $votes= rand(0, $nominalElectoralRegister);
                    }
                }

                PollingPlaceVote::factory()->create([
                    'election_id' => 1,
                    'polling_place_id' => $pollingPlace->id,
                    'party_coalition_id' => $party->id,
                    'votes' => $votes
                ]);
                $nominalElectoralRegister-= $votes;
            }

            $pp= PollingPlace::find($pollingPlace->id);
            $pp->leftover_ballots= $nominalElectoralRegister;
            $pp->received_ballots= $pollingPlace->nominal_electoral_register;
            if(random_int(0, 1)){ 
                $pp->digitized_record= '/img/actas/acta.jpeg';
            }
            $pp->capture_source= random_int(1, 2);
            $pp->special_ballots= 0;
            $pp->taken_ballots= 0;
            $pp->is_captured= true;
            $pp->save();

        }
    }
}
