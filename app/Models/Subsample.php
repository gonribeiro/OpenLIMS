<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subsample extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    protected $with = ['tests'];

    protected $appends = ['storage'];

    public function sample(): BelongsTo
    {
        return $this->belongsTo(Sample::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function tests(): MorphMany
    {
        return $this->morphMany(Test::class, 'sample');
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
