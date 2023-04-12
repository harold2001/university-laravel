<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create()->assignRole("maestro");

        UsersData::factory()->create([
            "user_id" => $user->id,
            "id_code" => "P".fake()->unique()->ean8()
        ]);
    }
}
