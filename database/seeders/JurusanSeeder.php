<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use DateTime;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create Jurusan
        Jurusan::create([
            'id_jurusan' => 'PRD001',
            'Nama_jurusan' => 'PENGEMBANGAN PERANGKAT LUNAK DAN GIM',
            'foto_jurusan' => 'foto jurusan/pplg.jpg',
            'created_at' => now()
        ]);

        Jurusan::create([
            'id_jurusan' => 'PRD002',
            'Nama_jurusan' => 'TEKNIK OTOMOTIF',
            'foto_jurusan' => 'foto jurusan/to.jpg',
            'created_at' => now()
        ]);
        Jurusan::create([
            'id_jurusan' => 'PRD003',
            'nama_jurusan' => 'AGRIBISNIS TERNAK',
            'foto_jurusan' => 'foto jurusan/at.jpg',
            'created_at' => now()
        ]);

        Jurusan::create([
            'id_jurusan' => 'PRD004',
            'Nama_jurusan' => 'AGRIBISNIS PERIKANAN',
            'foto_jurusan' => 'foto jurusan/ap.jpg',
            'created_at' => now()
        ]);
        Jurusan::create([
            'id_jurusan' => 'PRD005',
            'Nama_jurusan' => 'AGRIBISNIS PENGOLAHAN HASIL PERTANIAN',
            'foto_jurusan' => 'foto jurusan/aphp.jpg',
            'created_at' => now()
        ]);
        
    }
}
