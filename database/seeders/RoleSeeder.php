<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            // [
            //     'id' => '1',
            //     'name' => 'admin',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => '2',
            //     'name' => 'wisata',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => '3',
            //     'name' => 'kuliner',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => '4',
            //     'name' => 'penginapan',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => '5',
            //     'name' => 'pelanggan',
            //     'created_at' => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => '6',
            //     'name' => 'desa',
            //     'created_at' => \Carbon\Carbon::now(),
            // ]
            [
                'id' => '9',
                'name' => 'kota',
                'created_at' => \Carbon\Carbon::now(),
            ]

        ];

        foreach ($roles as $role) {
            Role::firstOrcreate([
                'id' => $role['id'],
                'name' => $role['name'],
                'created_at' => $role['created_at']
            ]);
        }
    }
}
