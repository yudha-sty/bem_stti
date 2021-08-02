<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\RoleRequest;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $query = Role::all();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success" href="' . route('role.show', $item->id) . '">
                            Lihat
                        </a>
                        <a class="btn btn-primary" href="' . route('role.edit', $item->id) . '">
                            Ubah
                        </a>
                        <button class="btn btn-danger delete_modal" type="button" data-id="' . $item->id . '" data-toggle="modal" data-target="#exampleModal">
                            Hapus
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make();
        }

        return view('pages.admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionDatas = Permission::get();
        $permission = [];

        foreach ($permissionDatas as $permissionData) {
            if (!Str::startsWith($permissionData->name, 'role')) {
                array_push($permission, $permissionData);
            }
        }

        return view('pages.admin.roles.create', [
            'permission' => $permission
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')->with('success', 'Role Berhasil Ditambahkan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('pages.admin.roles.show', [
            'data' => $data,
            'rolePermissions' => $rolePermissions
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
        $data = Role::find($id);

        $permissionDatas = Permission::get();
        $permission = [];

        foreach ($permissionDatas as $permissionData) {
            if (!Str::startsWith($permissionData->name, 'role')) {
                array_push($permission, $permissionData);
            }
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('pages.admin.roles.edit', [
            'data' => $data,
            'permission' => $permission,
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::where('name', 'Admin')->first();

        if ($role->id == $id) {
            return redirect()->route('role.index')->with('error', 'Tidak Dapat Mengubah Role Admin');
        }

        $data = Role::find($id);
        $data->name = $request->input('name');
        $data->save();

        $data->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')->with('success', 'Role Berhasil Diubah');
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

        if ($role->id == $id) {
            return response()->json([
                'message' => 'Tidak Dapat Menghapus Role Admin'
            ], 403);
        }

        $result = Role::findOrFail($id)->delete();

        return response()->json($result);
    }
}
