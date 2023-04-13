@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile',
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">

                            <h5 class="title text-primary mb-1">{{ auth()->user()->data_user->name }}
                                {{ auth()->user()->data_user->last_name }}</h5>
                            <p class="description">
                                ID: {{ auth()->user()->data_user->id_code }}
                            </p>
                        </div>
                        <p class="description text-center">
                            {{ __('I like the way you work it') }}
                            <br> {{ __('No diggity') }}
                            <br> {{ __('I wanna bag it up') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ __('12') }}
                                        <br>
                                        <small>{{ __('Files') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ __('2GB') }}
                                        <br>
                                        <small>{{ __('Used') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ __('24,6$') }}
                                        <br>
                                        <small>{{ __('Spent') }}</small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Team Members') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="avatar">
                                            <img src="{{ asset('paper/img/faces/ayo-ogunseinde-2.jpg') }}"
                                                alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        {{ __('DJ Khaled') }}
                                        <br />
                                        <span class="text-muted">
                                            <small>{{ __('Offline') }}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="avatar">
                                            <img src="{{ asset('paper/img/faces/joe-gardner-2.jpg') }}" alt="Circle Image"
                                                class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        {{ __('Creative Tim') }}
                                        <br />
                                        <span class="text-success">
                                            <small>{{ __('Available') }}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="avatar">
                                            <img src="{{ asset('paper/img/faces/clem-onojeghuo-2.jpg') }}"
                                                alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-ms-7 col-7">
                                        {{ __('Flume') }}
                                        <br />
                                        <span class="text-danger">
                                            <small>{{ __('Busy') }}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update', ['id' => auth()->user()->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">Editar mis datos</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Nombre:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Ingresa tu nombre" value="{{ auth()->user()->data_user->name }}">
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback m-0" style="display: block;" role="alert">
                                            <strong>Este campo no puede estar vacío.</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Apellidos:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0 mt-2">
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="Ingresa tu nombre"
                                            value="{{ auth()->user()->data_user->last_name }}">
                                    </div>
                                    @error('last_name')
                                        <span class="invalid-feedback m-0" style="display: block;" role="alert">
                                            <strong>Este campo no puede estar vacío.</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Teléfono:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0 mt-2">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Ingresa tu nombre" value="{{ auth()->user()->data_user->phone }}">
                                    </div>
                                    @error('phone')
                                        <span class="invalid-feedback m-0" style="display: block;" role="alert">
                                            <strong>Este campo no puede estar vacío.</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Email:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0 mt-2">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Ingresa tu email" value="{{ auth()->user()->email }}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>Este campo no puede estar vacío.</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">Cambiar mi contraseña</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Contraseña actual:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0">
                                        <input type="password" name="old_password" class="form-control"
                                            placeholder="Contraseña actual" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Contraseña nueva:</label>
                                <div class="col-md-9">
                                    <div class="form-group mb-0 mt-2">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Contraseña nueva" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Confirmar nueva contraseña:</label>
                                <div class="col-md-9">
                                    <div class="form-group m-0 mt-2">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirma tu nueva contraseña" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
