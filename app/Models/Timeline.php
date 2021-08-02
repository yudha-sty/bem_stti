<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'activity_date_start',
        'activity_date_end',
        'activity_time_start',
        'activity_time_end',
        'cover'
    ];
}
