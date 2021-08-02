<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use App\Models\HomepageSetting;
use App\Models\Timeline;
use App\Models\Documentation;
use App\Http\Controllers\Controller;
use App\Models\Quote;

class HomepageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepageSetting = HomepageSetting::first();
        $globalSetting = GlobalSetting::first();
        $quotes = Quote::inRandomOrder()->take(5)->get();
        $timelines = Timeline::latest()->take(3)->get();
        $documentations = Documentation::take(9)->get();

        return view('pages.user.beranda.index', [
            'homepageSetting' => $homepageSetting,
            'globalSetting'   => $globalSetting,
            'quotes'          => $quotes,
            'timelines'       => $timelines,
            'documentations'  => $documentations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
