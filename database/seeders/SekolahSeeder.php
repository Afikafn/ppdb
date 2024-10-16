<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use DateTime;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create ProgramStudi
        Sekolah::create([
            'npsn' => '20303097',
            'nama_sekolah' => 'SMPN 1 Karangreja',
            'kecamatan' => 'Karangreja',
            'created_at' => now()
        ]);

        Sekolah::create([
            'npsn' => '20303156',
            'nama_sekolah' => 'SMPN 2 Karangreja',
            'kecamatan' => 'Karangreja',
            'created_at' => now()
        ]);

        Sekolah::create([
            'npsn' => '20356158',
            'nama_sekolah' => 'SMPN 3 Karangreja',
            'kecamatan' => 'Karangreja',
            'created_at' => now()
        ]);

        
    }
}
