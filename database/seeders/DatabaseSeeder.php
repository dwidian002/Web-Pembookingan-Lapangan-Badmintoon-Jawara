<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'superadmin@mail.com',
            'password'=> bcrypt('superadmin'),
            'role'=>'admin',

        ]);

        DB::table('lapangan')->insert([
            ['nama_lapangan' => 'Lane 1'],
            ['nama_lapangan' => 'Lane 2']
        ]);

        DB::table('galeri')->insert([
            'judul_foto' => 'Lapangan',
            'foto_galeri'=> 'lapangan.jpg',
        ]);


        User::factory()->create([
            'name' => 'Joko',
            'email' => 'user@mail.com',
            'password'=> bcrypt('123'),
            'role'=>'pelanggan',

        ]);

        User::factory()->create([
            'name' => 'Ucok',
            'email' => 'user1@mail.com',
            'password'=> bcrypt('123'),
            'role'=>'pelanggan',

        ]);

        DB::table('session')->insert([
            ['id' => '1', 'name'=>'07.00-08.00 WIB'],
            ['id' => '2', 'name'=>'08.00-09.00 WIB'],
            ['id' => '3', 'name'=>'09.00-08.00 WIB'],
            ['id' => '4', 'name'=>'10.00-11.00 WIB'],
            ['id' => '5', 'name'=>'11.00-12.00 WIB'],
            ['id' => '6', 'name'=>'12.00-13.00 WIB'],
            ['id' => '7', 'name'=>'13.00-14.00 WIB'],
            ['id' => '8', 'name'=>'14.00-15.00 WIB'],
            ['id' => '9', 'name'=>'15.00-16.00 WIB'],
            ['id' => '10', 'name'=>'16.00-17.00 WIB'],
            ['id' => '11', 'name'=>'17.00-18.00 WIB'],
            ['id' => '12', 'name'=>'18.00-19.00 WIB'],
            ['id' => '13', 'name'=>'19.00-20.00 WIB'],
            ['id' => '14','name'=>'20.00-21.00 WIB'],
            ['id' => '15', 'name'=>'21.00-22.00 WIB'],
            ['id' => '16', 'name'=>'22.00-23.00 WIB'],
        ]);


    }
}
