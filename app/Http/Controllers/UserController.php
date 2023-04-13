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
use App\Models\UsersData;
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
        // Paso: Validar los datos recibidos del formulario.
        $validator = Validator::make($data->all(), [
            "name" => ["required"],
            "last_name" => ["required"],
            "phone" => ["required"],
            "email" => ["required", "email"],
            "password" => ['required', Rules\Password::defaults()],
            "rol" => ["required"]
        ]);

        if ($validator->fails()) { // Manejar la falla de la validación.
            $errors = $validator->errors();
            return redirect()->route("users.index")->with("error_form_add", "Faltan los siguientes datos en el formulario para añadir usuarios:")->withErrors($errors);
        } else {
            // Paso: Corroborar si el nombre del rol existe
            $roles = Role::all();
            $arrayRoles = []; // Guardo el nombre de los roles en un array
            foreach ($roles as $rol) {
                $arrayRoles[] = $rol->name;
            }
            $newRol = $data->rol;
            $responseExists = in_array($newRol, $arrayRoles, true); // Corroboro si es que el rol que recibí de el formulario existe en el array $arrayRoles.

            // Paso: Manejo las acciones en base a si existe o no el nuevo rol
            if ($responseExists) {
                // Paso: Guardar nuevos datos en la tabla "user".
                $newUser = User::create([
                    'email' => $data->email,
                    'password' => Hash::make($data->password),
                    'email_verified_at' => now()
                ])->assignRole($newRol);

                $newData = UsersData::create([
                    'user_id' => $newUser->id,
                    'name' => $data->name,
                    'last_name' => $data->last_name,
                    'phone' => $data->phone,
                ]);

                if ($newUser->hasRole('alumno')) {
                    $newData->id_code = "A" . fake()->unique()->ean8();
                } else {
                    $newData->id_code = "M" . fake()->unique()->ean8();
                }
                $newData->save();

                return redirect()->route("users.index")->with("success_form_add", "Operación exitosa: $newRol agregado");
            } else {
                return redirect()->route("users.index")->with("error_form_add", "El rol que seleccionaste no existe");
            }
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "new_name" => "required",
            "new_last_name" => "required",
            "new_phone" => "required",
            "new_email" => "required|email",
            "new_rol" => "required",
        ]);

        // Paso: Manejar la falla de la validación
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route("users.index")->with("error_form_edit", "El formulario para editar datos de usuario tiene errores o está incompleto.")->withErrors($errors);
        } else {
            // Paso: Actualizar los datos de la tabla "users".
            $user = User::find($id);
            $user->email = $request->new_email;
            if ($request->new_password !== null && $request->new_password !== "") {
                $user->password = Hash::make($request->new_password);
            }
            $user->save();

            // Paso: Actualizar los datos de la tabla "data_users".
            $userData = UsersData::where("user_id", $id)->first();
            $userData->name = $request->new_name;
            $userData->last_name = $request->new_last_name;
            $userData->phone = $request->new_phone;
            $userData->save();

            // Paso: Corroborar que el rol enviado desde el formulario no sea igual al que ya tiene el usuario
            $rolesUser = $user->getRoleNames();
            if ($rolesUser[0] !== $request->new_rol) {
                // Paso: Corroborar que el nuevo rol exista
                $roles = Role::all();
                $arrayRoles = []; // Guardo el nombre de los roles en un array
                foreach ($roles as $rol) {
                    $arrayRoles[] = $rol->name;
                }
                $newRol = $request->new_rol;
                $rolExists = in_array($newRol, $arrayRoles, true); // Corroboro si es que el rol que recibí de el formulario existe en el array $arrayRoles.

                // Paso: Manejo las acciones en base a si existe o no el nuevo rol
                if ($rolExists) {
                    // Paso: Remuevo todos los roles para que esté libre de errores
                    foreach ($arrayRoles as $rol) {
                        $user->removeRole($rol);
                    }
                    // Paso: Asigno el nuevo rol
                    $user->assignRole($newRol);

                    if (($rolesUser[0] === "admin" || "maestro") && $newRol === "alumno") {
                        $userData->id_code = "A" . substr($userData->id_code, 1);
                        $userData->save();
                    } else {
                        $userData->id_code = "M" . substr($userData->id_code, 1);
                        $userData->save();
                    }
                } else {
                    return redirect()->route("users.index")->with("error_form_edit", "El rol que seleccionaste no existe");
                }
            }
            return redirect()->route("users.index")->with("success_form_edit", "Datos del usuario $userData->name $userData->last_name actualizados correctamente.");
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route("users.index")->with("success_form_delete", "Usuario eliminado");
    }
}
