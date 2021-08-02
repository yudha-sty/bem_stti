<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GlobalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:pengaturan-dasar', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengaturan-dasar', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengaturan-dasar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengaturan-dasar', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GlobalSetting::first();

        return view('pages.admin.settings.globalSettings.index', [
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
        $item = GlobalSetting::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('navbar_logo')) {
            Storage::delete('public/' . $item->navbar_logo);
            $data['navbar_logo'] = $request->file('navbar_logo')->store('web/global', 'public');
        }

        if ($request->hasFile('page_banner')) {
            Storage::delete('public/' . $item->page_banner);
            $data['page_banner'] = $request->file('page_banner')->store('web/global', 'public');
        }

        $item->update($data);

        return redirect()->route('global-setting.index')->with('success', 'Pengaturan Berhasil Di Simpan');
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
