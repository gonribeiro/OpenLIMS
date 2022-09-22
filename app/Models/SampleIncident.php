<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleIncident extends Model
{
    use HasFactory;

    public function samples()
    {
        return $this->morphedByMany(Sample::class, 'sample');
    }

    public function subsamples()
    {
        return $this->morphedByMany(Subsample::class, 'sample');
    }

    public function incidents()
    {
        return $this->belongsToMany(Incident::class);
    }
}
