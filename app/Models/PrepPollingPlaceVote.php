<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepPollingPlaceVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'polling_place_id',
        'party_coalition_id',
        'votes',
    ];

    protected $casts = [
        'id' => 'integer',
        'prep_polling_place_record_id' => 'integer',
        'prep_party_coalition_id' => 'integer',
        'votes' => 'integer',
    ];

    /*public function pollingPlace(): BelongsTo
    {
        return $this->belongsTo(PollingPlace::class);
    }

    public function partyCoalition(): BelongsTo
    {
        return $this->belongsTo(PartyCoalition::class);
    }

    public static function totalVotes($electionId){
        $query= PollingPlaceVote::where('election_id', $electionId)->sum('votes');
        return $query;
    }*/
}
