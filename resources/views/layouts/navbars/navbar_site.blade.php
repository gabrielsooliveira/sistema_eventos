<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-xl">
        <span class="navbar-brand">Logo</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnavbar" aria-controls="mainnavbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainnavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ (Route::current()->getName() == 'index_events' ? 'active' : '') }}" href="{{ route('index_events') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Route::current()->getName() == 'create_events' ? 'active' : '') }}" href="{{ route('create_events') }}">Criar evento</a>
                </li>
            </ul>

            <div class="col-md-3 text-end">
                @if (Auth::check())
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" type="button" href="{{ route('index_dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('logout_user') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item" type="button">
                            <form id="logout-form" action="{{ route('logout_user') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            Sair
                        </a></li>
                    </ul>
                </div>
                @else
                    <a type="button" class="btn btn-outline-light btn-sm" href="{{ route('login_user') }}"><i class="fa-solid fa-circle-user"></i> Iniciar Sessão</a>
                @endif
            </div>
        </div>
    </div>
</nav>