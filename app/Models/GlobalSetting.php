<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'navbar_logo',
        'navbar_title',
        'primary_color',
        'secondary_color',
        'primary_text_color',
        'secondary_text_color',
        'page_banner'
    ];
}
