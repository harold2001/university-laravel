<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
        ])->assignRole('admin');

        UsersData::factory()->create([
            "user_id" => $user->id,
            "name" => "Admin",
            "last_name" => "Test",
        ]);
    }
}
