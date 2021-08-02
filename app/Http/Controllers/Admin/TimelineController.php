<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Timeline;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\TimelineRequest;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:jadwal-list|jadwal-create|jadwal-edit|jadwal-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:jadwal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jadwal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jadwal-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Timeline::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-block" href="' . route('timeline.edit', $item->id) . '">
                            Ubah
                        </a>
                        <button class="btn btn-danger btn-block delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                            Hapus
                        </button>
                    ';
                })
                ->editColumn('description', function ($item) {
                    return '
                        <p class="line-clamp">' . $item->description . '</p>
                    ';
                })
                ->editColumn('cover', function ($item) {
                    $image = Storage::exists('public/' . $item->cover) && $item->cover ? Storage::url($item->cover) : asset('asset/images/imagePlaceholder.png');
                    return '
                        <div class="image-wrapper">
                            <div class="image" style="background-image: url(' . $image . ')"></div>
                        </div>
                    ';
                })
                ->editColumn('activity_date', function ($item) {
                    return '
                        ' . Carbon::parse($item->activity_date_start)->format('d/m/Y') . ' - ' . Carbon::parse($item->activity_date_end)->format('d/m/Y') . '
                    ';
                })
                ->editColumn('activity_time', function ($item) {
                    return '
                        ' . Carbon::createFromFormat('H:i:s', $item->activity_time_start)->format('H:i') . ' - ' . Carbon::createFromFormat('H:i:s', $item->activity_time_end)->format('H:i') . '
                    ';
                })
                ->rawColumns(['action', 'cover', 'activity_date', 'activity_time', 'description'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.timeline.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.timeline.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimelineRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['cover'] = $request->file('cover')->store('cover/timeline', 'public');

        Timeline::create($data);

        return redirect()->route('timeline.index')->with('success', 'Data Jadwal Berhasil Di Simpan');
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
        $data = Timeline::findOrFail($id);

        return view('pages.admin.timeline.edit', [
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
    public function update(TimelineRequest $request, $id)
    {
        $data = $request->all();
        $item = Timeline::findOrFail($id);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover')) {
            Storage::delete('public/' . $item->cover);

            $data['cover'] = $request->file('cover')->store('cover/timeline', 'public');
        }

        $item->update($data);

        return redirect()->route('timeline.index')->with('success', 'Data Jadwal Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Timeline::findOrFail($id);
        Storage::delete('public/' . $data->cover);

        $result = $data->delete();

        return response()->json($result);
    }
}
