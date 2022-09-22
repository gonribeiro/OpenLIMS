<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function subsamples(): HasMany
    {
        return $this->hasMany(Subsample::class);
    }
}
