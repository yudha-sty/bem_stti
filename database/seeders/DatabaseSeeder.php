<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\PermissionTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateAnggotaUserSeeder::class);
        $this->call(QuoteSeeder::class);
        $this->call(DokumentasiSeeder::class);
        $this->call(TimelineSeeder::class);
    }
}
