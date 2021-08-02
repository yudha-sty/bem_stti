<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $role = Role::where('name', 'Admin')->first();
            $data = DB::table('model_has_roles')->where('role_id', $role->id)->first();

            $query = User::where([
                ['id', '!=', $data->model_id],
                ['id', '!=', Auth::id()]
            ])->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary" href="' . route('user.edit', $item->id) . '">
                            Ubah
                        </a>
                        <button class="btn btn-danger delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                            Hapus
                        </button>
                    ';
                })
                ->editColumn('roles', function ($item) {
                    $return = '';

                    if (!empty($item->getRoleNames())) {
                        foreach ($item->getRoleNames() as $v) {
                            $return .= '<label class="badge badge-success mr-2">' . $v . '</label>';
                        }
                    }

                    return $return;
                })
                ->rawColumns(['action', 'roles'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Admin')->pluck('name', 'name')->all();

        return view('pages.admin.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambahkan');
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
        $data = User::find($id);
        $roles = Role::where('name', '!=', 'Admin')->pluck('name', 'name')->all();
        $userRoles = $data->roles->pluck('name', 'name')->all();

        return view('pages.admin.users.edit', [
            'data' => $data,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, array('password'));
        }

        $item = User::find($id);
        $item->update($data);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $item->assignRole($request->input('roles'));

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::where('name', 'Admin')->first();

        $data = DB::table('model_has_roles')->where('role_id', $role->id)->first();

        if ($data->model_id == $id) {
            return response()->json([
                'message' => 'Tidak Dapat Menghapus User Admin'
            ], 403);
        }

        $result = User::findOrFail($id)->delete();

        return response()->json($result);
    }
}
