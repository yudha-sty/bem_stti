<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:quotes-list|quotes-create|quotes-edit|quotes-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:quotes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:quotes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:quotes-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Quote::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-block" href="' . route('quotes.edit', $item->id) . '">
                            Ubah
                        </a>
                        <button class="btn btn-danger btn-block delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                            Hapus
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.quote.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.quote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quote::create($request->all());

        return redirect()->route('quotes.index')->with('success', 'Quote Berhasil Di Tambahkan');
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
        $data = Quote::findOrFail($id);

        return view('pages.admin.quote.edit', [
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
    public function update(Request $request, $id)
    {
        $item = Quote::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('quotes.index')->with('success', 'Quote Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Quote::destroy($id);

        return response()->json($result);
    }
}
