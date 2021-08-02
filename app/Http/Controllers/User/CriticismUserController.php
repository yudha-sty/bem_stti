<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\AspirasiRequest;
use App\Models\CriticismAndSuggestion;

class CriticismUserController extends Controller
{
    public function index(){
        $globalSetting = GlobalSetting::first();

        return view('pages.user.kritikDanSaran.index', [
            'globalSetting'   => $globalSetting
        ]);
    }
    public function store(AspirasiRequest $request)
    {
        $data = $request->all();
        $data['date'] = Carbon::now();

        CriticismAndSuggestion::create($data);

        return redirect()->back()->with('success', 'Aspirasi, Kritik dan Saran Berhasil Di Suarakan');
    }
}
