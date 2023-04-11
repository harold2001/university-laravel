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
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_user">
            Añadir usuario
        </button>

        <!-- Modal -->
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
                                <label for="id_code" class="form-label">Código de identificación:</label>
                                <input type="text" name="id_code" class="form-control" id="id_code"
                                    placeholder="Ingresa un código de identificación único">
                                <small class="form-text text-muted">(Sólo si aplica)</small>
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
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
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
                            <button type="submit" class="btn btn-primary">Añadir usuario</button>
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
                                <th>Rol</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th class="text-right">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @switch($user)
                                            @case($user->hasRole('admin'))
                                                @php
                                                    $hasOne = 'teacher';
                                                @endphp
                                                <span class="btn btn-info m-0 rol">Admin</span>
                                            @break

                                            @case($user->hasRole('teacher'))
                                                @php
                                                    $hasOne = 'teacher';
                                                @endphp
                                                <span class="btn btn-info m-0 rol">Maestro</span>
                                            @break

                                            @case($user->hasRole('student'))
                                                @php
                                                    $hasOne = 'student';
                                                @endphp
                                                <span class="btn btn-info m-0 rol">Estudiante</span>
                                            @break

                                            @default
                                                @php
                                                    $hasOne = 'Sólo email y password.';
                                                @endphp
                                                <span class="btn btn-info m-0 rol">No tiene rol</span>
                                        @endswitch
                                    </td>

                                    @if ($hasOne !== 'Sólo email y password.')
                                        <td>{{ $user->$hasOne->name }}</td>
                                        <td>{{ $user->$hasOne->last_name }}</td>
                                        <td>{{ $user->$hasOne->phone }}</td>
                                    @else
                                        <td>{{ $hasOne }}</td>
                                        <td>{{ $hasOne }}</td>
                                        <td>{{ $hasOne }}</td>
                                    @endif
                                    <td class="text-right">{{ $user->email }}</td>
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
