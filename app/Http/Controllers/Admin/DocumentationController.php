<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\DocumentationRequest;
use Yajra\DataTables\Facades\DataTables;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:dokumentasi-list|dokumentasi-create|dokumentasi-edit|dokumentasi-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:dokumentasi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dokumentasi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dokumentasi-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Documentation::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-block" href="' . route('dokumentasi.edit', $item->id) . '">
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
                ->rawColumns(['action', 'cover', 'description'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.documentation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.documentation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentationRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['cover'] = $request->file('cover')->store('cover/dokumentasi', 'public');

        Documentation::create($data);

        return redirect()->route('dokumentasi.index')->with('success', 'Data Dokumentasi Berhasil Di Simpan');
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
        $data = Documentation::findOrFail($id);

        return view('pages.admin.documentation.edit', [
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
    public function update(DocumentationRequest $request, $id)
    {
        $data = $request->all();
        $item = Documentation::findOrFail($id);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover')) {
            Storage::delete('public/' . $item->cover);

            $data['cover'] = $request->file('cover')->store('cover/dokumentasi', 'public');
        }

        $item->update($data);

        return redirect()->route('dokumentasi.index')->with('success', 'Data Dokumentasi Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Documentation::findOrFail($id);
        Storage::delete('public/' . $data->cover);

        $result = $data->delete();

        return response()->json($result);
    }
}
