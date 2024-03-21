<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PollingPlaceVote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'polling_place_id',
        'party_coalition_id',
        'votes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'polling_place_id' => 'integer',
        'party_coalition_id' => 'integer',
        'votes' => 'integer',
    ];

    public function pollingPlace(): BelongsTo
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
    }
}
