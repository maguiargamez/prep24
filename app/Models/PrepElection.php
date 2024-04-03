<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrepElection extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded =[];

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prep_election_type_id',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prep_election_type_id' => 'integer',
    ];

    public function candidates(): HasMany
    {
        return $this->hasMany(PrepCandidate::class);
    }

    public function pollingPlaces(): HasMany
    {
        return $this->hasMany(CCasilla::class);
    }

    public function electionType(): BelongsTo
    {
        return $this->belongsTo(PrepElectionType::class, 'prep_election_type_id');
    }

    /*public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class)->withDefault([
            'name' => '-'
        ]);
    }*/

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('description', 'like', '%'.$term.'%');
        });
    }
}
