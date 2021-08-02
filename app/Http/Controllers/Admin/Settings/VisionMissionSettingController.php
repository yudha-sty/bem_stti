<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VisionMissionSetting;
use Illuminate\Support\Facades\Storage;

class VisionMissionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:pengaturan-visiMisi', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengaturan-visiMisi', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengaturan-visiMisi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengaturan-visiMisi', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VisionMissionSetting::first();

        return view('pages.admin.settings.visionMissionSettings.index', [
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
        $item = VisionMissionSetting::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('illustration_1')) {
            Storage::delete('public/' . $item->illustration_1);
            $data['illustration_1'] = $request->file('illustration_1')->store('web/visionMission', 'public');
        }

        if ($request->hasFile('illustration_2')) {
            Storage::delete('public/' . $item->illustration_2);
            $data['illustration_2'] = $request->file('illustration_2')->store('web/visionMission', 'public');
        }

        $item->update($data);

        return redirect()->route('vision-mission-setting.index')->with('success', 'Pengaturan Berhasil Di Simpan');
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
