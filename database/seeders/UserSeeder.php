<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfileUser;
use App\Models\Timeline;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        User::create([
            'name' => 'Iam Admin',
            'password' => Hash::make('12345678'),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'Administrator',
            'created_at' => now()
        ]);
        ProfileUser::create([
            'user_id' => 13,
            'nama' => 'Iam Admin',
            'email' => 'admin@gmail.com',
            'created_at' => now()
        ]);
        Timeline::create([
            'user_id' => 1,
            'status' => "Bergabung",
            'pesan' => 'Membuat Akun baru',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
    }
}
