<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create()->assignRole("alumno");

        UsersData::factory()->create([
            "user_id" => $user->id,
            "id_code" => "A".fake()->unique()->ean8()
        ]);
    }
}
