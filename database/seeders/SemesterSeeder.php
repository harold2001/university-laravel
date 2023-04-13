<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [["Semestre 1", "Inicio de curso: aprenderás conceptos básicos."], ["Semestre 2", "Continúas con tu crecimiento básico."], ["Semestre 3", "Comienzas con tus cursos medios."], ["Semestre 4", "Continúas con tu crecimiento medio."], ["Semestre 5", "Inicias tus cursos avanzados."], ["Semestre 6", "Continúas con tu crecimiento avanzando."], ["Semestre 7", "Inicias tus proyectos finales."], ["Semestre 8", "Último empujón para graduarte."],];
        
        foreach ($semesters as $semester) {
            Semester::create([
                "name" => $semester[0],
                "description" => $semester[1]
            ]);
        }
    }
}
