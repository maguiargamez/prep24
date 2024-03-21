<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartyCoalition extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded =[];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'election_id',
        'short',
        'name',
        'logo',
        'parties',
        'is_coalition',
        'is_independent',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'id' => 'integer',
        'election_id' => 'integer',
        'parties' => 'array',
        'is_coalition' => 'boolean',
        'is_independent' => 'boolean',
        'is_active' => 'boolean',
    ];*/

    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class);
    }

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('name', 'like', '%'.$term.'%');
        });
    }
}
