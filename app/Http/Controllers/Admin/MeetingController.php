<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\MeetingRequest;
use Carbon\Carbon;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:rapat-list|rapat-create|rapat-edit|rapat-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:rapat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rapat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rapat-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Meeting::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    if ($item->statusRapat == 'belum') {
                        $return = '
                            <div class="btn-group">
                                <div class="dropdown">
                                    <buttton class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                                        Status
                                    </buttton>
                                    <div class="dropdown-menu">
                                    <form action="' . route('rapat-status.update', $item->id) . '" method="POST">
                                        ' . method_field('PUT') . csrf_field() . '
                                        <input type="hidden" name="statusRapat" value="berhasil">
                                        <button class="dropdown-item text-success" type="submit">
                                            Berhasil
                                        </button>
                                    </form>
                                    <form action="' . route('rapat-status.update', $item->id) . '" method="POST">
                                        ' . method_field('PUT') . csrf_field() . '
                                        <input type="hidden" name="statusRapat" value="gagal">
                                        <button class="dropdown-item text-danger" type="submit">
                                            Gagal
                                        </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <a class="btn btn-primary" href="' . route('rapat.edit', $item->id) . '">
                                Ubah
                            </a>
                            <button class="btn btn-danger delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                                Hapus
                            </button>
                        ';
                    } elseif ($item->statusRapat == 'berhasil') {
                        $return = '
                            <button class="btn btn-success w-100" type="button" disabled>
                                <i class="fas fa-check"></i>
                            </button>
                        ';
                    } else {
                        $return = '
                            <button class="btn btn-danger w-100" type="button" disabled>
                                <i class="fas fa-times"></i>
                            </button>
                        ';
                    }

                    return $return;
                })
                ->editColumn('waktuRapat', function ($item) {
                    return '
                        ' . Carbon::parse($item->waktuRapat)->format('d M Y, H:i') . '
                    ';
                })
                ->editColumn('statusRapat', function ($item) {
                    if ($item->statusRapat == 'belum') {
                        $return = '<p class="text-warning">Belum Terlaksanakan</p>';
                    } elseif ($item->statusRapat == 'berhasil') {
                        $return = '<p class="text-success">Berhasil Terlaksanakan</p>';
                    } else {
                        $return = '<p class="text-danger">Gagal  Terlaksanakan</p>';
                    }

                    return $return;
                })
                ->rawColumns(['action', 'waktuRapat', 'statusRapat'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.meeting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.meeting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRequest $request)
    {
        $data = $request->all();
        $data['notulenRapat'] = Auth::user()->name;

        Meeting::create($data);

        return redirect()->route('rapat.index')->with('success', 'Agenda Rapat Berhasil Di Tambahkan');
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
        $data = Meeting::findOrFail($id);
        $data->waktuRapat = strtotime($data->waktuRapat);
        $waktu = date('Y-m-d\TH:i', $data->waktuRapat);

        return view('pages.admin.meeting.edit', [
            'data' => $data,
            'waktu' => $waktu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingRequest $request, $id)
    {
        $item = Meeting::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('rapat.index')->with('success', 'Agenda Rapat Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Meeting::findOrFail($id);

        $result = $data->delete();

        return response()->json($result);
    }
}
