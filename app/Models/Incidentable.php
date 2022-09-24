<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidentable extends Model
{
    use HasFactory;

    public $table = 'Incidentables';

    protected $guarded = [''];

    public $timestamps = false;
}
