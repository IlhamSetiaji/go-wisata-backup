<?php

namespace Database\Seeders;

use App\Models\Tempat;
use Illuminate\Database\Seeder;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 0; $i < 10; $i++){
        //     Tempat::create([
        //         'user_id' => 'D001',
        //         'kategori' => 'wisata',
        //         'name' => 'Wisata Test-'.$i,
        //         'deskripsi' => 'Deskripsi Test-'.$i,
        //         'alamat' => 'Alamat Test-'.$i,
        //         'email' => 'wisata'.$i.'@test.com',
        //         'telp' => '08123456789',
        //         'status' => 1,
        //         'htm' => 10000,
        //     ]);
        // }
       $tempat = Tempat::all();
       $tempat->each(function($e) {
              $e->update([
                'creator_id' => '370'
              ]);
       });
    }
}
