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
            'Nama_jurusan' => 'TEKNOLOGI REKAYASA MANUFAKTUR',
            'foto_jurusan' => 'foto prodi/Prodi1671193438-mesin.jpg',
            'created_at' => now()
        ]);

        Jurusan::create([
            'id_jurusan' => 'PRD002',
            'Nama_jurusan' => 'TEKNOLOGI REKAYASA MEKATRONIKA',
            'foto_jurusan' => 'foto prodi/Prodi1671193459-mekatronika.jpeg',
            'created_at' => now()
        ]);
        Jurusan::create([
            'id_jurusan' => 'PRD003',
            'nama_jurusan' => 'TEKNOLOGI REKAYASA PERANGKAT LUNAK',
            'foto_jurusan' => 'foto prodi/Prodi1671193502-trpl.jpg',
            'created_at' => now()
        ]);

        Jurusan::create([
            'id_jurusan' => 'PRD004',
            'Nama_jurusan' => 'TEKNOLOGI LISTRIK',
            'foto_jurusan' => 'foto prodi/Prodi1671193482-listrik.jpg',
            'created_at' => now()
        ]);
        
    }
}
