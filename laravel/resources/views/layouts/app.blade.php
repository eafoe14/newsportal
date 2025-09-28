<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новостной портал')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Добавленные стили из предоставленного кода */
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; }
        .form-group input, .form-group textarea, .form-group select { 
            width: 100%; padding: 0.5rem; border: 1px solid #ddd; 
        }
        .btn { 
            padding: 0.5rem 1rem; background: #d32f2f; color: white; 
            border: none; cursor: pointer; text-decoration: none;
            display: inline-block;
        }
        .btn:hover { background: #b71c1c; }
        
        /* Messages */
        .alert { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        
        /* Application cards */
        .application-card { 
            border: 1px solid #ddd; padding: 1rem; margin: 1rem 0; 
            border-left: 4px solid #ffa000;
        }
        .application-card.approved { border-left-color: #4caf50; }
        .application-card.rejected { border-left-color: #f44336; }
    </style>
</head>
<body>
    <!-- Шапка сайта -->
    <header class="header">
        <div class="container">
            <div class="header__main">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Логотип">
                </a>
                
                <div class="header__top-info">
                    <span class="weather">Гродно: +5°C</span>
                    
                    <!-- Блок авторизации -->
                    <div class="auth-section">
                        @auth
                            <!-- Если пользователь авторизован -->
                            <div class="user-menu">
                                <button class="user-menu__toggle">
                                    <span class="user-menu__name">{{ Auth::user()->name }}</span>
                                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                                        <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>
                                <div class="user-menu__dropdown">
                                    <!-- Добавленные ссылки в зависимости от роли -->
                                    @if(Auth::user()->role === 'advertiser')
                                        <a href="/advertiser/dashboard" class="user-menu__link">Панель управления</a>
                                        <a href="/advertiser/applications" class="user-menu__link">Все заявки</a>
                                    @else
                                        <a href="/applications/create" class="user-menu__link">Подать заявку</a>
                                        <a href="/my-applications" class="user-menu__link">Мои заявки</a>
                                    @endif
                                    <a href="/profile" class="user-menu__link">Профиль</a>
                                    <a href="{{ route('logout') }}" class="user-menu__link" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Если пользователь не авторизован -->
                            <div class="auth-links">
                                <a href="{{ route('login') }}" class="auth-link auth-link--login">Войти</a>
                                <a href="{{ route('register') }}" class="auth-link auth-link--register">Регистрация</a>
                            </div>
                        @endauth
                    </div>
                    
                    <button class="search-toggle" aria-label="Поиск">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
                
                <button class="menu-toggle" aria-label="Открыть меню">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Основная навигация (только для десктопа) -->
        <nav class="main-nav desktop-only">
            <div class="container">
                <div class="nav__inner">
                    <a class="nav__link nav__link--active" href="{{ route('home') }}">Главная</a>
                    <a class="nav__link" href="#">Власть</a>
                    <a class="nav__link" href="#">Общество</a>
                    <a class="nav__link" href="#">Экономика</a>
                    <a class="nav__link" href="#">Образование</a>
                    <a class="nav__link" href="#">Безопасность</a>
                    <a class="nav__link" href="#">В мире</a>
                    <a class="nav__link" href="#">В стране</a>
                    <a class="nav__link" href="#">Культура</a>
                    <a class="nav__link" href="#">Спорт</a>
                    <a class="nav__link" href="#">В мире</a>
                    <a class="nav__link" href="#">Здоровье</a>

                    
                    <!-- Кнопка "Рубрики" с выпадающим меню -->
                    <div class="nav-dropdown">
                        <button class="nav-dropdown__toggle">Рубрики ▾</button>
                        <div class="nav-dropdown__menu">
                            <a class="nav-dropdown__link" href="#">Вас услышат</a>
                            <a class="nav-dropdown__link" href="#">Видеоновости</a>
                            <a class="nav-dropdown__link" href="#">Мнения</a>
                            <a class="nav-dropdown__link" href="#">Новости компаний</a>
                            <a class="nav-dropdown__link" href="#">Советы в дорогу</a>
                            <a class="nav-dropdown__link" href="#">Происшествия</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Поисковая строка -->
        <div class="search-bar">
            <div class="container">
                <form class="search-form">
                    <input type="text" placeholder="Поиск новостей..." class="search-input">
                    <button type="submit" class="search-btn">Найти</button>
                </form>
            </div>
        </div>
    </header>

 <!-- Мобильное меню -->
    <div class="mobile-menu">
        <div class="mobile-menu__header">
            <span>Меню</span>
            <button class="mobile-menu__close">&times;</button>
        </div>
        
        <div class="mobile-menu__info">
            <span class="date">{{ now()->format('d.m.Y') }}</span>
            <span class="weather">Гродно: +5°C</span>
        </div>

        <!-- Блок авторизации в мобильном меню -->
        <div class="mobile-menu__auth">
            @auth
                <!-- Если пользователь авторизован -->
                <div class="mobile-user-info">
                    <div class="mobile-user__name">{{ Auth::user()->name }}</div>
                    <div class="mobile-user__links">
                        <!-- Добавленные ссылки в зависимости от роли -->
                        @if(Auth::user()->role === 'advertiser')
                            <a href="/advertiser/dashboard" class="mobile-user__link">Панель управления</a>
                            <a href="/advertiser/applications" class="mobile-user__link">Все заявки</a>
                        @else
                            <a href="/applications/create" class="mobile-user__link">Подать заявку</a>
                            <a href="/my-applications" class="mobile-user__link">Мои заявки</a>
                        @endif
                        <a href="/profile" class="mobile-user__link">Профиль</a>
                        <a href="{{ route('logout') }}" class="mobile-user__link" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выйти
                        </a>
                    </div>
                </div>
            @else
                <!-- Если пользователь не авторизован -->
                <div class="mobile-auth">
                    <a href="{{ route('login') }}" class="mobile-auth__link mobile-auth__link--login">Войти</a>
                    <a href="{{ route('register') }}" class="mobile-auth__link mobile-auth__link--register">Регистрация</a>
                </div>
            @endauth
        </div>

        <nav class="mobile-nav">
            <a class="mobile-nav__link mobile-nav__link--active" href="{{ route('home') }}">Главная</a>
            <a class="mobile-nav__link" href="#">Власть</a>
            <a class="mobile-nav__link" href="#">Общество</a>
            <a class="mobile-nav__link" href="#">Экономика</a>
            <a class="mobile-nav__link" href="#">Образование</a>
            <a class="mobile-nav__link" href="#">Безопасность</a>
            <a class="mobile-nav__link" href="#">В мире</a>
            <a class="mobile-nav__link" href="#">В стране</a>
            <a class="mobile-nav__link" href="#">Вас услышат</a>
            <a class="mobile-nav__link" href="#">Видеоновости</a>
            <a class="mobile-nav__link" href="#">Культура</a>
            <a class="mobile-nav__link" href="#">Мнения</a>
            <a class="mobile-nav__link" href="#">Новости компаний</a>
            <a class="mobile-nav__link" href="#">Советы в дорогу</a>
            <a class="mobile-nav__link" href="#">Происшествия</a>
            <a class="mobile-nav__link" href="#">Спорт</a>
            <a class="mobile-nav__link" href="#">Здоровье</a>
        </nav>
    </div>

    <!-- Основной контент -->
    <main class="main">
        <div class="container">
            <!-- Добавленные блоки сообщений -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Подвал сайта -->
    <footer style="background: #333; color: white; padding: 2rem 0; text-align: center;">
        <div class="container">
            &copy; {{ date('Y') }} НовостиРФ. Все права защищены.
        </div>
    </footer>

    <!-- Форма выхода (скрытая) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>