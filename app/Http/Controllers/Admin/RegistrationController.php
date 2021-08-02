<?php

namespace App\Http\Controllers\Admin;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\RegistrationSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\User\RegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:pendaftaran-list|pendaftaran-create|pendaftaran-edit|pendaftaran-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pendaftaran-detail', ['only' => ['show']]);
        $this->middleware('permission:pendaftaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pendaftaran-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = RegistrationSetting::first();

        if (request()->ajax()) {
            $query = Registration::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    if ($item->statusTerima == null) {
                        $return = '
                            <a class="btn btn-success btn-block" href="' . route('pendaftaran.show', $item->id) . '">
                                Lihat
                            </a>
                            <a class="btn btn-primary btn-block" href="' . route('pendaftaran.edit', $item->id) . '">
                                Ubah
                            </a>
                            <button class="btn btn-danger btn-block delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                                Hapus
                            </button>
                        ';
                    } else {
                        if ($item->statusTerima == 1) {
                            $return = '
                                <button class="btn btn-success btn-block" type="button" disabled>
                                    Di Terima
                                </button>
                            ';
                        } else {
                            $return = '
                                <button class="btn btn-danger btn-block" type="button" disabled>
                                    Di Tolak
                                </button>
                            ';
                        }
                    }
                    return $return;
                })
                ->editColumn('foto', function ($item) {
                    return '
                        <div class="image-wrapper">
                            <div class="image" style="background-image: url(' . Storage::url($item->foto) . ')"></div>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'foto'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.registration.index', [
            'setting' => $setting
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
        $data = Registration::findOrFail($id);
        return view('pages.admin.registration.show', [
            'data' => $data
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
        $data = Registration::findOrFail($id);
        return view('pages.admin.registration.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrationRequest $request, $id)
    {
        $item = Registration::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            Storage::delete('public/' . $item->foto);
            $data['foto'] = $request->file('foto')->store('pendaftaran/foto', 'public');
        }

        if ($request->hasFile('swafoto')) {
            Storage::delete('public/' . $item->swafoto);
            $data['swafoto'] = $request->file('swafoto')->store('pendaftaran/swafoto', 'public');
        }

        $item->update($data);

        return redirect()->route('pendaftaran.index')->with('success', 'Data Pendaftaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Registration::findOrFail($id);

        Storage::delete('public/' . $data->foto);
        Storage::delete('public/' . $data->swafoto);

        $result = $data->delete();

        return response()->json($result);
    }
}
