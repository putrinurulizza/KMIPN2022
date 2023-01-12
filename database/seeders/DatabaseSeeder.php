<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\JenisSurat;
use Illuminate\Database\Seeder;
use App\Models\PerangkatGampong;
use App\Models\Solusi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'alamat' => fake()->city(),
            'no_hp' => fake()->unique()->numerify('852########'),
            'role' => 1,
        ]);

        User::factory(10)->create();

        Kategori::create([
            'nama' => 'Sosial',
            'slug' => 'sosial'
        ]);
        
        Kategori::create([
            'nama' => 'Pengumuman',
            'slug' => 'pengumuman'
        ]);

        Berita::factory(20)->create();

        JenisSurat::create([
            'nama' => 'Surat Kuasa'
        ]);

        JenisSurat::create([
            'nama' => 'Surat Keterangan Catatan Kepolisian'
        ]);

        JenisSurat::create([
            'nama' => 'Surat Pengantar Laporan Kehilangan'
        ]);

        Jabatan::create([
            'nama' => 'Geuchik'
        ]);

        Jabatan::create([
            'nama' => 'Sekretaris Desa'
        ]);

        Jabatan::create([
            'nama' => 'Bendahara Desa'
        ]);

        Jabatan::create([
            'nama' => 'Tuha 4'
        ]);

        PerangkatGampong::create([
            'nama' => 'Muhammad',
            'id_jabatan' => 1
        ]);

        PerangkatGampong::create([
            'nama' => 'Siska',
            'id_jabatan' => 2
        ]);

        PerangkatGampong::create([
            'nama' => 'Fatimah',
            'id_jabatan' => 3
        ]);

        PerangkatGampong::create([
            'nama' => 'Baharuddin',
            'id_jabatan' => 4
        ]);

        Solusi::factory(20)->create();
    }
}
