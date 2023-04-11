<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(User $model)
    {
        return view("users.index", [
            "users" => User::all(),
            "roles" => Role::all()
        ]);
    }

    public function store(Request $data)
    {
        // Validar los datos recibidos del formulario.
        $validator = Validator::make($data->all(), [
            "name" => ["required"],
            "last_name" => ["required"],
            "phone" => ["required"],
            "id_code" => ["required"],
            "email" => ["required", "email"],
            "password" => ['required', Rules\Password::defaults()],
        ]);

        // Manejar la falla de la validación.
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route("users.index")->with("error_form_add", "Faltan los siguientes datos en el formulario para añadir usuarios:")->withErrors($errors);
        } else {
            // Guardar en la tabla "user".
            $newUser = new User();
            $newUser->email = $data->email;
            $newUser->password = Hash::make($data->password);
            $newUser->save();

            // ACÁ FALTA COLOCAR LA CORROBORACIÓN DE LA ID
            $rolInput = $data->rol;

            // Corroborar qué rol fue asignado para guardar la data en la tabla "teachers" o "students".
            switch ($rolInput) {
                case $rolInput === "1" || $rolInput === "2":
                    $newTeacher = new Teacher();
                    $newTeacher->user_id = $newUser->id;
                    $newTeacher->name = $data->name;
                    $newTeacher->last_name = $data->last_name;
                    $newTeacher->phone = $data->phone;
                    $newTeacher->save();

                    if ($rolInput === "1") {
                        $newUser->assignRole("admin");
                        return redirect()->route("users.index")->with("success_form_add", "Admin agregado");
                    } else {
                        $newUser->assignRole("teacher");
                        return redirect()->route("users.index")->with("success_form_add", "Maestro agregado");
                    }
                    break;
                case "3":
                    $newTeacher = new Student();
                    $newTeacher->user_id = $newUser->id;
                    $newTeacher->name = $data->name;
                    $newTeacher->last_name = $data->last_name;
                    $newTeacher->phone = $data->phone;
                    $newTeacher->id_code = $data->id_code;
                    $newTeacher->save();

                    $newUser->assignRole("student");
                    return redirect()->route("users.index")->with("success_form_add", "Alumno agregado");
                    break;
            }
        }

        return $data;
    }
}
