@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'courses',
])

@section('content')
    <div class="content">
        @if (session('deleted_status'))
            <div class="alert alert-danger" role="alert">
                {{ session('deleted_status') }}
            </div>
        @endif
        @if (session('error_status'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="courses">
                        <thead class=" text-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Semestre</th>
                                <th>Carrera</th>
                                <th>Link de la clase</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>{{ $course->semester->name }}</td>
                                    <td>{{ $course->career->name }}</td>
                                    <td>{{ $course->link }}</td>
                                    <td class="text-right">
                                        <!-- Edit Button-->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit_user_{{ $course->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </button>

                                        <!-- Edit Modal-->
                                        <div class="modal fade text-left" id="edit_user_{{ $course->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Editar datos del curso: {{ $course->name }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('courses.update', $course->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label for="new_name_{{ $course->id }}"
                                                                    class="">Nombre del curso:</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    id="new_name_{{ $course->id }}"
                                                                    value="{{ $course->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_link_{{ $course->id }}"
                                                                    class="">Link de la clase:</label>
                                                                <input type="text" name="link" class="form-control"
                                                                    id="new_link_{{ $course->id }}"
                                                                    value="{{ $course->link }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_semester_{{ $course->id }}"
                                                                    class="">Semestre asignado:</label>
                                                                <select class="form-control" name="semester_id"
                                                                    id="new_semester_{{ $course->id }}" required>
                                                                    @foreach ($semesters as $semester)
                                                                        @if ($semester->id === $course->semester_id)
                                                                            <option value="{{ $semester->id }}" selected>
                                                                                {{ $semester->name }}</option>
                                                                        @else
                                                                            <option value="{{ $semester->id }}">
                                                                                {{ $semester->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_semester_{{ $course->id }}"
                                                                    class="">Carrera asignada:</label>
                                                                <select class="form-control" name="career_id"
                                                                    id="new_semester_{{ $course->id }}" required>
                                                                    @foreach ($careers as $career)
                                                                        @if ($career->id === $course->career_id)
                                                                            <option value="{{ $career->id }}" selected>
                                                                                {{ $career->name }}</option>
                                                                        @else
                                                                            <option value="{{ $career->id }}">
                                                                                {{ $career->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_description_{{ $course->id }}"
                                                                    class="form-label">Descripción:</label>
                                                                <textarea class="form-control" id="new_description_{{ $course->id }}" style="min-height: 200px" required name="description">{{ $course->description }}</textarea>
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
                                            data-bs-target="#delete_user_{{ $course->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </button>

                                        <!-- Delete Modal-->
                                        <div class="modal fade text-center" id="delete_user_{{ $course->id }}"
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
                                                        <form action="{{ route('courses.destroy', $course->id) }}"
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#courses').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
