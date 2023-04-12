<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#">
            <div class="d-flex col-12 justify-content-center">
                <div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Brigham_Young_University_medallion.svg"
                        height="50">
                </div>
            </div>
        </a>
        {{-- <a href="#" class="simple-text logo-normal">
            BYU
        </a> --}}
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>PÁGINA PRINCIPAL</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <span class="sidebar-normal">MI PERFIL</span>
                </a>
            </li>

            <li class="{{ $elementActive == 'users' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    {{-- <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i> --}}
                    <i class="nc-icon nc-badge"></i>
                    <p>
                        USUARIOS
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'users' ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/users.svg') }}"
                                        alt="Users" height="20"></span>
                                <span class="sidebar-normal">TODOS</span>
                            </a>
                        </li>
                        {{-- <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li class="active-pro {{ $elementActive == 'upgrade' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'upgrade') }}" class="bg-danger">
                    <i class="nc-icon nc-spaceship text-white"></i>
                    <p class="text-white">{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
