<?php

namespace App\Models;

use App\Models\Documentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentationView extends Model
{
    use HasFactory;

    public function documentationView()
    {
        return $this->belongsTo(Documentation::class);
    }

    public static function createViewLog($documentation)
    {
        $postsViews = new DocumentationView();
        $postsViews->documentation_id = $documentation->id;
        $postsViews->url = request()->url();
        $postsViews->session_id = request()->getSession()->getId();
        $postsViews->user_id = (auth()->check()) ? auth()->id() : null;
        $postsViews->ip = request()->ip();
        $postsViews->agent = request()->header('User-Agent');
        $postsViews->save();
    }
}
