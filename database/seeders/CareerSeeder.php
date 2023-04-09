<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $Careers = [
            [
                "name" => "Front-End",
                "description" => "Aprenderás a usar las teconologías básicas para el desarrollo de web como JavaScript, HTML, CSS, entre otras."
            ],
            [
                "name" => "Back-End",
                "description" => "Aprenderás a usar las teconologías básicas para el desarrollo de web como PHP y Laravel."
            ]
        ];

        foreach ($Careers as $Career) {
            Career::create([
                "name" => $Career["name"],
                "description" => $Career["description"]
            ]);
        }
    }
}
