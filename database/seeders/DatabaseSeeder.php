<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call([
            RoleSeeder::class,
            CareerSeeder::class,
        ]);

        $user = User::factory()->create([
            'email' => 'admin@admin.com'
        ])->assignRole('admin');

        DB::table('teachers')->insert([
            "user_id" => $user->id,
            "name" => "Admin",
            "last_name" => "Test",
            "phone" => fake()->phoneNumber(),
        ]);

        Teacher::factory(5)->create();
        Student::factory(10)->create();
    }
}
