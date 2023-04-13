@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'users',
])

@section('content')
    <div class="content">
        <!---------- Anuncios --------->
        @if (session('error_form_add'))
            <div class="alert alert-danger col-11 text-white" role="alert">
                <span>{{ session('error_form_add') }}</span>
                <ul class="m-0">
                    @error('name')
                        <li>ApellidosNombre</li>
                    @enderror
                    @error('last_name')
                        <li>Apellidos</li>
                    @enderror
                    @error('id_code')
                        <li>Código Oficial</li>
                    @enderror
                    @error('email')
                        <li>Email</li>
                    @enderror
                    @error('phone')
                        <li>Número de teléfono</li>
                    @enderror
                    @error('password')
                        <li>Contraseña</li>
                    @enderror
                    @error('rol')
                        <li>Rol</li>
                    @enderror
                </ul>
            </div>
        @endif

        @if (session('success_form_add'))
            <div class="alert alert-success col-11 text-white" role="alert">
                <span>{{ session('success_form_add') }}</span>
            </div>
        @endif

        @if (session('success_form_delete'))
            <div class="alert alert-danger col-11 text-white" role="alert">
                <span>{{ session('success_form_delete') }}</span>
            </div>
        @endif

        @if (session('success_form_edit'))
            <div class="alert alert-success col-11 text-white" role="alert">
                <span>{{ session('success_form_edit') }}</span>
            </div>
        @endif

        @if (session('error_form_edit'))
            <div class="alert alert-danger col-11 text-white" role="alert">
                <span>{{ session('error_form_edit') }}</span>
                @if ($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
            </div>
        @endif
        <!---------- Fin anuncios --------->
        <!-- Add Button -->
        <button type="button" class="btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#add_user">
            Añadir usuario
        </button>

        <!-- Add Modal-->
        <div class="modal fade" id="add_user" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresa los datos del nuevo usuario:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Nombres:</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Ingresa los nombres" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="form-label">Apellidos:</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    placeholder="Ingresa los apellidos" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="Ingresa el número telefónico" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Escribe una contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Escribe una contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="rol" class="form-label">Asigna un rol:</label>
                                <select class="form-control" name="rol" id="rol">
                                    <option selected disabled>Selecciona un rol aquí:</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="">
                                        Option one is this
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div> --}}
                            <div class="col-12 d-flex justify-content-end p-0 m-0">
                                <button type="submit" class="btn btn-primary">Añadir usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="users">
                        <thead class=" text-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->data_user->name }}</td>
                                    <td>{{ $user->data_user->last_name }}</td>
                                    <td>{{ $user->data_user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        @switch($user)
                                            @case($user->hasRole('admin'))
                                                <span class="btn btn-info m-0 rol">{{ $user->getRoleNames()[0] }}</span>
                                            @break

                                            @case($user->hasRole('maestro'))
                                                <span class="btn btn-info m-0 rol">{{ $user->getRoleNames()[0] }}</span>
                                            @break

                                            @case($user->hasRole('alumno'))
                                                <span class="btn btn-info m-0 rol">{{ $user->getRoleNames()[0] }}</span>
                                            @break

                                            @default
                                                <span class="btn btn-info m-0 rol">No tiene rol</span>
                                        @endswitch
                                    </td>
                                    <td class="text-right">
                                        <!-- Edit Button-->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit_user_{{ $user->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </button>

                                        <!-- Edit Modal-->
                                        <div class="modal fade text-left" id="edit_user_{{ $user->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Editar datos de {{ $user->data_user->name }}
                                                            {{ $user->data_user->last_name }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($user->hasAnyRole(['maestro', 'alumno']))
                                                            <strong class="form-text text-muted text-center mt-0 mb-2">Si
                                                                cambias el rol de este usuario a "alumno" o "maestro", su
                                                                código de identificación será actualizado.</strong>
                                                        @endif
                                                        <form action="{{ route('users.update', $user->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            @if (!$user->hasRole('admin'))
                                                                <div class="form-group">
                                                                    <label for="new_id_code_{{ $user->id }}"
                                                                        class="form-label">Código de
                                                                        identificación:</label>
                                                                    <input type="text"
                                                                        name="new_id_code_{{ $user->id }}"
                                                                        class="form-control"value="{{ $user->data_user->id_code }}"
                                                                        disabled>
                                                                </div>
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="new_name_{{ $user->id }}"
                                                                    class="">Nombres:</label>
                                                                <input type="text" name="new_name"
                                                                    class="form-control"
                                                                    id="new_name_{{ $user->id }}"
                                                                    value="{{ $user->data_user->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_last_name_{{ $user->id }}"
                                                                    class="form-label">Apellidos:</label>
                                                                <input type="text" name="new_last_name"
                                                                    class="form-control"
                                                                    id="new_last_name_{{ $user->id }}"
                                                                    value="{{ $user->data_user->last_name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_phone_{{ $user->id }}"
                                                                    class="form-label">Teléfono:</label>
                                                                <input type="text" name="new_phone"
                                                                    class="form-control"
                                                                    id="new_phone_{{ $user->id }}"
                                                                    value="{{ $user->data_user->phone }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_email_{{ $user->id }}"
                                                                    class="form-label">Email:</label>
                                                                <input type="email" name="new_email"
                                                                    class="form-control"
                                                                    id="new_email_{{ $user->id }}"
                                                                    value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password_{{ $user->id }}"
                                                                    class="form-label">Nueva
                                                                    contraseña:</label>
                                                                <input type="new_password" name="new_password"
                                                                    class="form-control"
                                                                    id="new_password_{{ $user->id }}"
                                                                    placeholder="Escribe una nueva contraseña">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_rol_{{ $user->id }}"
                                                                    class="form-label">Cambiar el
                                                                    rol:</label>
                                                                <select class="form-control" name="new_rol"
                                                                    id="new_rol_{{ $user->id }}">
                                                                    <option selected disabled>Selecciona un rol:
                                                                    </option>
                                                                    @foreach ($roles as $rol)
                                                                        @switch($user)
                                                                            @case($user->hasRole('admin') && $rol->id === 1)
                                                                                <option value="{{ $rol->name }}" selected>
                                                                                    {{ $rol->name }}
                                                                                </option>
                                                                            @break

                                                                            @case($user->hasRole('maestro') && $rol->id === 2)
                                                                                <option value="{{ $rol->name }}" selected>
                                                                                    {{ $rol->name }}
                                                                                </option>
                                                                            @break

                                                                            @case($user->hasRole('alumno') && $rol->id === 3)
                                                                                <option value="{{ $rol->name }}" selected>
                                                                                    {{ $rol->name }}
                                                                                </option>
                                                                            @break

                                                                            @default
                                                                                <option value="{{ $rol->name }}">
                                                                                    {{ $rol->name }}
                                                                                </option>
                                                                            @break
                                                                        @endswitch
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end p-0 m-0">
                                                                <button type="submit" class="btn btn-primary">Actualizar
                                                                    datos</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Button-->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_user_{{ $user->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </button>

                                        <!-- Delete Modal-->
                                        <div class="modal fade text-center" id="delete_user_{{ $user->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body py-4">
                                                        <p class="fs-5 m-0">¿Seguro que deseas eliminar este registro?</p>
                                                    </div>
                                                    <div class="modal-footer d-flex align-items-center gap-2 py-3">
                                                        <button type="button" class="btn btn-secondary m-0"
                                                            data-bs-dismiss="modal"
                                                            style="box-shadow: none">Cancelar</button>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" class="m-0">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-primary m-0">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#users').DataTable({
                    responsive: true,
                    autoWidth: false
                });
            });
        </script>
        <style>
            .rol {
                cursor: default !important;
            }
        </style>
    @endsection
