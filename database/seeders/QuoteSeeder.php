<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quote = [
            [
                'quote'  => 'Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia',
                'author' => 'Nelson Mandela'
            ],
            [
                'quote'  => 'Pendidikan adalah tiket ke masa depan. Hari esok dimiliki oleh orang-orang yang mempersiapkan dirinya sejak hari ini',
                'author' => 'Malcolm X'
            ],
            [
                'quote'  => 'Gantungkan cita-cita mu setinggi langit! Bermimpilah setinggi langit. Jika engkau jatuh, engkau akan jatuh di antara bintang-bintang',
                'author' => 'Ir. Soekarno'
            ],
            [
                'quote'  => 'Tujuan pendidikan itu untuk mempertajam kecerdasan, memperkukuh kemauan serta memperhalus perasaan',
                'author' => 'Tan Malaka'
            ],
        ];

        for ($i = 0; $i < 4; $i++) {
            $data = [
                'quote' => $quote[$i]['quote'],
                'author' => $quote[$i]['author']
            ];

            Quote::create($data);
        }
    }
}
