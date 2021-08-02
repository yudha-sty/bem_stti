<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class MemberAdmissionController extends Controller
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
        //
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
        $item = Registration::findOrFail($id);

        if ($request['statusTerima'] == 1) {
            $status = "Diterima";

            $password = 'BEMSTTI_' . $item->nim;

            $user = User::create([
                'name' => $item->namaLengkap,
                'email' => $item->email,
                'password' => Hash::make($password)
            ]);

            $role = Role::where('name', 'Anggota')->first();

            if ($role == null) {
                $role = Role::create(['name' => 'Anggota']);

                $permissionDatas = Permission::get();
                $process1 = [];
                $process2 = [];
                $permission = [];

                foreach ($permissionDatas as $permissionData) {
                    if (!Str::startsWith($permissionData->name, 'role')) {
                        array_push($process1, $permissionData);
                    }
                }

                foreach ($process1 as $data_1) {
                    if (Str::endsWith($data_1->name, 'list')) {
                        array_push($process2, $data_1);
                    }
                }

                foreach ($process2 as $data_2) {
                    array_push($permission, $data_2->id);
                }

                $role->syncPermissions($permission);
            } else {
                $user->assignRole([$role->id]);
            }
        } else {
            $status = "Ditolak";
        }

        $item->update($request->all());

        return redirect()->route('pendaftaran.show', $id)->with('success', 'Berhasil, ' . $item->namaLengkap . ' Telah ' . $status);
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
