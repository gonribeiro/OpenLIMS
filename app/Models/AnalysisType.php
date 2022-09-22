<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnalysisType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function analyses(): HasMany
    {
        return $this->hasMany(Analysis::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
