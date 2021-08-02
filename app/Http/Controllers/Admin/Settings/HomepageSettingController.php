<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomepageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:pengaturan-halamanUtama', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengaturan-halamanUtama', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengaturan-halamanUtama', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengaturan-halamanUtama', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HomepageSetting::first();

        return view('pages.admin.settings.homepageSettings.index', [
            'data' => $data
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
        $item = HomepageSetting::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('header_cover')) {
            Storage::delete('public/' . $item->header_cover);
            $data['header_cover'] = $request->file('header_cover')->store('web/homepage', 'public');
        }

        if ($request->hasFile('section_cabinet_logo')) {
            Storage::delete('public/' . $item->section_cabinet_logo);
            $data['section_cabinet_logo'] = $request->file('section_cabinet_logo')->store('web/homepage', 'public');
        }

        $item->update($data);

        return redirect()->route('homepage-setting.index')->with('success', 'Pengaturan Berhasil Di Simpan');
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
