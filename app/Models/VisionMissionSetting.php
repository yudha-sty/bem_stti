<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMissionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'vision',
        'mission',
        'illustration_1',
        'illustration_2',
        'illustration_visibility'
    ];
}
