<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Admin
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        // Kepala Sekolah
        $kepsek = \App\Models\User::factory()->create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@example.com',
        ]);
        $kepsek->assignRole('kepala_sekolah');

        // Guru
        $guru = \App\Models\User::factory()->create([
            'name' => 'Guru Pembimbing',
            'email' => 'guru@example.com',
        ]);
        $guru->assignRole('guru_pendamping');

        // Categories
        $categories = \App\Models\Category::factory(10)->create();

        // Penjual
        \App\Models\User::factory(10)->create()->each(function ($user) use ($categories) {
            $user->assignRole('penjual');
            // Create Profile
            \App\Models\PenjualProfile::create([
                'user_id' => $user->id,
                'nis' => rand(10000, 99999),
                'kelas' => 'XII RPL 1',
                'jurusan' => 'RPL',
                'alamat_toko' => 'Kantin Sekolah',
                'deskripsi_toko' => 'Jualan makanan enak',
                'status_verifikasi' => 'verified',
            ]);
            
            // Create Products
            \App\Models\Product::factory(5)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        });

        // Pembeli
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('pembeli');
        });
    }
}