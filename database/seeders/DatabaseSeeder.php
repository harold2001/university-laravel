<?php

namespace Database\Seeders;

use App\Models\DataUser;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
            SemesterSeeder::class,
            CourseSeeder::class,
            UserAdminSeeder::class
        ]);

        $amountUsers = 5;

        for ($i = 0; $i < $amountUsers; $i++) {
            $this->call(TeacherSeeder::class);
        }

        for ($i = 0; $i < $amountUsers; $i++) {
            $this->call(StudentSeeder::class);
        }
    }
}
