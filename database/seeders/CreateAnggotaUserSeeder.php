<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAnggotaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Anggota',
            'email' => 'anggota@bem.ac.id',
            'password' => bcrypt('12345678')
        ]);

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

        $user->assignRole([$role->id]);
    }
}
