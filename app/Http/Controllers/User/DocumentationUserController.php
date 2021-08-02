<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\GlobalSetting;
use App\Models\DocumentationView;
use App\Http\Controllers\Controller;

class DocumentationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentations = Documentation::all();
        $globalSetting = GlobalSetting::first();

        return view('pages.user.dokumentasi.index', [
            'documentations' => $documentations,
            'globalSetting'   => $globalSetting
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
    public function show($slug)
    {
        $documentation = Documentation::with(['documentationView'])->where('slug', $slug)->first();

        if ($documentation->showDocumentation()) {
            return view('pages.user.dokumentasi.details', [
                'documentation' => $documentation
            ]);
        }

        $documentation->increment('views');
        DocumentationView::createViewLog($documentation);

        return view('pages.user.dokumentasi.details', [
            'documentation' => $documentation
        ]);
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
