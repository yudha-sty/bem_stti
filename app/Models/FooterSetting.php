<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_logo',
        'footer_title',
        'footer_email',
        'footer_address',
        'footer_telepon',
        'footer_map',
        'footer_copyright'
    ];
}
