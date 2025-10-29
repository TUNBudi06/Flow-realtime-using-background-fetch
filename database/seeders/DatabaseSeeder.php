<?php

namespace Database\Seeders;

use App\Models\TractorListModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'team' => 'IT',
            'nik' => '0001',
        ]);

        TractorListModel::insert([
            [
                'No' => 1,
                'Model' => 'TRC-2024-001',
                'Keterangan' => 'Tractor dalam kondisi baik, siap digunakan untuk produksi',
                'image' => 'https://tse3.mm.bing.net/th/id/OIP.mw7ihkUQBfvsiBRQHph5zwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3',
                'name' => 'John Doe',
                'nik' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'No' => 2,
                'Model' => 'TRC-2024-002',
                'Keterangan' => 'Sedang dalam maintenance rutin',
                'image' => 'https://tractormanualz.com/wp-content/uploads/2019/02/LS-Tractor-H-140.jpg',
                'name' => 'Jane Smith',
                'nik' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'No' => 3,
                'Model' => 'TRC-2024-003',
                'Keterangan' => 'Baru selesai inspeksi, ready for operation',
                'image' => 'https://tse1.mm.bing.net/th/id/OIP.RK_JEOypdJ8FD_6hVGZxHgAAAA?w=350&h=198&rs=1&pid=ImgDetMain&o=7&rm=3',
                'name' => 'Ahmad Yani',
                'nik' => '1122334455',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
