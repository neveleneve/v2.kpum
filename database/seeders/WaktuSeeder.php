<?php

namespace Database\Seeders;

use App\Models\Waktu;
use Illuminate\Database\Seeder;

class WaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waktu::insert([
            [
                'nama' => 'Buka',
                'tanggal' => date('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Tutup',
                'tanggal' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
