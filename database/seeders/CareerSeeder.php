<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                "name" => "Front-End",
                "description" => "Aprenderás a usar las teconologías básicas para el desarrollo de web como JavaScript, HTML, CSS, entre otras."
            ],
            [
                "name" => "Back-End",
                "description" => "Aprenderás a usar las teconologías básicas para el desarrollo de web como PHP y Laravel."
            ]
        ];

        foreach ($careers as $career) {
            Career::create([
                "name" => $career["name"],
                "description" => $career["description"]
            ]);
        }
    }
}
