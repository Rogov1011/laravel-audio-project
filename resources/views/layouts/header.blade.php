<header>
    <nav class="navbar navbar-expand-lg" style="background-color: #96ee9a">
        <div class="container">
            <a class="navbar-brand" href="{{ route('app.main') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @hasanyrole('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Консоль администратора
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('Category.index') }}">Категории звуков</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('sound.index') }}">Звуки</a></li>
                            <li><a class="dropdown-item" href="{{ route('review.index') }}">Жалобы</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Пользователи</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles.index') }}">Роли</a></li>
                            <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Права</a></li>
                        </ul>
                    </li>
                    @endhasanyrole
                </ul>
                <form action="" method="GET" class="d-flex mx-5">
                    <input class="form-control me-2" name="search" type="text" placeholder="Найти" aria-label="Search">
                    <button class="btn btn-outline-success">Поиск</button>
                    <a class="btn btn-outline-success mx-2" href="/">Сбросить</a>
                </form>
            </div>
            @if (auth()->user())
                <li class="nav-item d-flex mx-3">
                    {{ auth()->user()->name }}
                </li>
                <li class="nav-item d-flex mx-3">
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger">Выйти</button>
                    </form>
                </li>
            @else
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('auth.register') }}">Регистрация</a>
                        <a class="nav-link active" aria-current="page" href="{{ route('auth.loginPage') }}">Вход</a>
                    </li>
                </ul>
            @endif
        </div>
    </nav>
</header>
