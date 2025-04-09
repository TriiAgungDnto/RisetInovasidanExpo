<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            'name' => 'Sistem Informasi'
        ]);
        Major::create([
            'name' => 'Teknik Informatika'
        ]);
        Major::create([
            'name' => 'Management'
        ]);
        Major::create([
            'name' => 'Komunikasi'
        ]);
        Major::create([
            'name' => 'Magister Teknik Informatika'
        ]);
        Major::create([
            'name' => 'Akuntansi'
        ]);
    }
}
