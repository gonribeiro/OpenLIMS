<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    protected $with = ['tests', 'subsamples'];

    protected $appends = ['storage'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function sampleType(): BelongsTo
    {
        return $this->belongsTo(SampleType::class);
    }

    public function collectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'collected_by_id');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by_id');
    }

    public function discardedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'discarded_by_id');
    }

    public function tests(): MorphMany
    {
        return $this->morphMany(Test::class, 'sample');
    }

    public function subsamples(): HasMany
    {
        return $this->hasMany(Subsample::class);
    }

    public function custodies(): MorphMany
    {
        return $this->morphMany(Custody::class, 'sample');
    }

    public function getStorageAttribute(): string | null
    {
        return $this->custodies->last()?->storage->name;
    }

    public function incidents(): MorphToMany
    {
        return $this->morphToMany(Incident::class, 'incidentable');
    }
}
