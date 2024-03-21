<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'election_id',
        'party_coalition_id',
        'key',
        'name',
        'logo',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'election_id' => 'integer',
        'party_coalition_id' => 'integer',
        'is_active' => 'boolean',
    ];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }

    public function partyCoalition(): BelongsTo
    {
        return $this->belongsTo(PartyCoalition::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('name', 'like', '%'.$term.'%');
        });
    }

    public static function candidatesAdvance($electionId){
        $candidates= Candidate::select(
            'candidates.id',
            'candidates.name',
            'candidates.photo',
            'candidates.is_special',
            'party_coalitions.name as partyName',
            'party_coalitions.logo as partyLogo',
            )
            ->leftJoin('party_coalitions', 'party_coalitions.id', '=', 'candidates.party_coalition_id')
            ->where('candidates.election_id', $electionId)
            ->get();



        foreach ($candidates as $candidate) {
            $candidatePartyCoallitions= CandidatePartyCoalition::select('party_coalition_id')
            ->where('candidate_id', $candidate->id)
            ->pluck('party_coalition_id');
            $candidate->parties= $candidatePartyCoallitions;

            $votes= PollingPlaceVote::whereIn('party_coalition_id', $candidate->parties)->sum('votes');
            $candidate->votes= $votes;
        }
        //dd($candidates);
        return $candidates;
    }

    public static function candidatesDistrict($electionId){
        $candidates= Candidate::select(
            'candidates.id',
            'candidates.name',
            'candidates.photo',
            'candidates.is_special',
            'party_coalitions.name as partyName',
            'party_coalitions.logo as partyLogo',
            )
            ->leftJoin('party_coalitions', 'party_coalitions.id', '=', 'candidates.party_coalition_id')
            ->where('candidates.election_id', $electionId)
            ->get();



        foreach ($candidates as $candidate) {
            $candidatePartyCoallitions= CandidatePartyCoalition::select('party_coalition_id')->where('candidate_id', $candidate->id)->pluck('party_coalition_id');
            $candidate->parties= $candidatePartyCoallitions;

            $votes= PollingPlaceVote::whereIn('party_coalition_id', $candidate->parties)->sum('votes');
            $candidate->votes= $votes;
        }
        //dd($candidates);
        return $candidates;
    }
}