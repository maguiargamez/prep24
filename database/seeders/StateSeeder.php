<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        State::insert([
            [
                'key' => '07',
                'name' => 'Chiapas',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }
}
