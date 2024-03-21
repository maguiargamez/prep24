<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        Municipality::insert([
            [
                'state_id'=> 1,
                'key' => '07',
                'name' => 'Tuxtla',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);

    }
}
