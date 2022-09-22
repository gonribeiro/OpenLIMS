<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function sample(): MorphTo // sample or subsample
    {
        return $this->morphTo();
    }

    public function analysis(): BelongsTo
    {
        return $this->belongsTo(Analysis::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
