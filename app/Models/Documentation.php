<?php

namespace App\Models;

use App\Models\DocumentationView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'publish_date',
        'cover',
        'views'
    ];

    protected $dates = [
        'publish_date'
    ];

    public function documentationView()
    {
        return $this->hasMany(DocumentationView::class);
    }

    public function showDocumentation()
    {
        if (auth()->check()) {
            return $this->documentationView()
                ->where(function ($documentationViewQuery) {
                    $documentationViewQuery
                        ->where('session_id', '=', request()->getSession()->getId())
                        ->orWhere('user_id', '=', auth()->id());
                })->exists();
        }

        return $this->documentationView()
            ->where('ip', '=',  request()->ip())->exists();
    }
}
