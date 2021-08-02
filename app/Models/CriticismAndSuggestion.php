<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriticismAndSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'date'
    ];
}
