<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dokumentasi-list',
            'dokumentasi-create',
            'dokumentasi-edit',
            'dokumentasi-delete',
            'quotes-list',
            'quotes-create',
            'quotes-edit',
            'quotes-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'jadwal-list',
            'jadwal-create',
            'jadwal-edit',
            'jadwal-delete',
            'rapat-list',
            'rapat-create',
            'rapat-edit',
            'rapat-delete',
            'pendaftaran-list',
            'pendaftaran-detail',
            'pendaftaran-setting',
            'pendaftaran-edit',
            'pendaftaran-delete',
            'pengaturan-list',
            'pengaturan-halamanUtama',
            'pengaturan-visiMisi',
            'pengaturan-strukturKabinet',
            'pengaturan-dasar',
            'pengaturan-footer',
            'kritikDanSaran-list',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
