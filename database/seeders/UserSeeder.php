<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@gmail.com'),
            'role_id' => '1',
            'petugas_id' => 'D001',
            'created_at' => \Carbon\Carbon::now(),

        ]);

        $users = [

            // [
            //     'name' => 'admwisataa',
            //     'email' => 'wisataa@gmail.com',
            //     'password' => Hash::make('wisataa@gmail.com'),
            //     'role_id' => '2',
            //     'petugas_id' => 'D002',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'name' => 'admrestauranta',
            //     'email' => 'restauranta@gmail.com',
            //     'password' => Hash::make('restauranta@gmail.com'),
            //     'role_id' => '3',
            //     'petugas_id' => 'D003',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'name' => 'admhotela',
            //     'email' => 'hotela@gmail.com',
            //     'password' => Hash::make('hotela@gmail.com'),
            //     'role_id' => '4',
            //     'petugas_id' => 'D004',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'name' => 'customer',
            //     'email' => 'customer@gmail.com',
            //     'password' => Hash::make('customer@gmail.com'),
            //     'role_id' => '5',
            //     'petugas_id' => 'D005',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'name' => 'admdesaa',
            //     'email' => 'desa@gmail.com',
            //     'password' => Hash::make('desa@gmail.com'),
            //     'role_id' => '6',
            //     'petugas_id' => 'D006',
            //     'created_at' => \Carbon\Carbon::now(),
            // ]

        ];

        // foreach ($users as $user) {
        //     User::firstOrcreate([
        //         'name' => $user['name'],
        //         'email' => $user['email'],
        //         'password' => $user['password'],
        //         'role_id' => $user['role_id'],
        //         'petugas_id' => $user['petugas_id'],
        //         'created_at' => $user['created_at']
        //     ]);
        // }
    }
}
