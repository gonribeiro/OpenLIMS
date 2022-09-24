<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    protected $with = ['samples', 'subsamples'];

    public function samples()
    {
        return $this->morphedByMany(Sample::class, 'incidentable');
    }

    public function subsamples()
    {
        return $this->morphedByMany(Subsample::class, 'incidentable');
    }
}
