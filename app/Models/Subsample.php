<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subsample extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    protected $with = ['tests'];

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

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'sample_id');
    }
}
