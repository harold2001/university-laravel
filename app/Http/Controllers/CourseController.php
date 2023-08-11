<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("courses.index", [
            "courses" => Course::all(),
            "semesters" => Semester::all(),
            "careers" => Career::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required||min:6",
            "link" => "required",
            "semester_id" => "required",
            "career_id" => "required",
            "description" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrorStatus("Error al actualizar. Verifique los datos.")->withInput();
        }
        
        $course->update($request->all());
        // return $course;
        return back()->withUpdatedStatus("Curso actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->withDeletedStatus("Usuario eliminado");
    }
}
