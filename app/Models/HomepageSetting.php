<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_title',
        'header_title_font_size',
        'header_subtitle',
        'header_subtitle_font_size',
        'header_cover',
        'section_cabinet_title',
        'section_cabinet_title_font_size',
        'section_cabinet_subtitle',
        'section_cabinet_subtitle_font_size',
        'section_cabinet_logo'
    ];
}
