<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Timeline;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i = 0; $i < 3; $i++) {

            $title = 'Timeline Kegiatan ' . ($i + 1);

            $data = [
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'activity_date_start' => Carbon::now()->format('Y-m-d'),
                'activity_date_end' => Carbon::tomorrow()->format('Y-m-d'),
                'activity_time_start' => Carbon::now()->format('H:i:s'),
                'activity_time_end' => Carbon::tomorrow()->addHour()->format('H:i:s'),
                'cover' => null,
            ];

            Timeline::create($data);
        }
    }
}
