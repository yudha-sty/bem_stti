<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Models\FooterSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:pengaturan-footer', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengaturan-footer', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengaturan-footer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengaturan-footer', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FooterSetting::first();

        return view('pages.admin.settings.footerSettings.index', [
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
        $item = FooterSetting::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('footer_logo')) {
            Storage::delete('public/' . $item->footer_logo);
            $data['footer_logo'] = $request->file('footer_logo')->store('web/footer', 'public');
        }

        $item->update($data);

        return redirect()->route('footer-setting.index')->with('success', 'Pengaturan Berhasil Di Simpan');
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
