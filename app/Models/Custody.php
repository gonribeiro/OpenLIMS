<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Custody extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $with = ['storage'];

    public function sample(): MorphTo // sample or subsample
    {
        return $this->morphTo();
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }
}
