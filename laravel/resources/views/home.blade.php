@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <!-- Главные новости -->
    <section class="hero-news">
        <div class="container">
            <div class="hero-news__grid">
                <article class="hero-main">
                    <img src="https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                         alt="Главная новость" class="hero-main__image">
                    <div class="hero-main__content">
                        <span class="news-card__category">Политика</span>
                        <h2 class="hero-main__title">Важное политическое событие недели: итоги и последствия</h2>
                        <p class="hero-main__excerpt">Эксперты анализируют последние политические изменения и их влияние на экономику страны в ближайшей перспективе.</p>
                        <div class="news-card__meta">
                            <span class="news-card__date">Сегодня, 10:23</span>
                            <span class="news-card__views">1.2K просмотров</span>
                        </div>
                    </div>
                </article>
                
                <div class="hero-sidebar">
                    <article class="side-news">
                        <div class="side-news__content">
                            <span class="news-card__category">Экономика</span>
                            <h3 class="side-news__title">Курс рубля укрепился на фоне новых экономических мер</h3>
                            <div class="news-card__meta">
                                <span class="news-card__date">Сегодня, 09:15</span>
                            </div>
                        </div>
                    </article>
                    
                    <article class="side-news">
                        <div class="side-news__content">
                            <span class="news-card__category">Спорт</span>
                            <h3 class="side-news__title">Российские спортсмены завоевали 5 золотых медалей на международных соревнованиях</h3>
                            <div class="news-card__meta">
                                <span class="news-card__date">Вчера, 18:45</span>
                            </div>
                        </div>
                    </article>
                    
                    <article class="side-news">
                        <div class="side-news__content">
                            <span class="news-card__category">Здоровье</span>
                            <h3 class="side-news__title">Ученые представили новое лекарство от вирусных заболеваний</h3>
                            <div class="news-card__meta">
                                <span class="news-card__date">Вчера, 16:30</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- Последние новости -->
    <section class="news-section">
        <div class="container">
            <div class="category-section">
                <div class="category-header">
                    <h2 class="category-title">Последние новости</h2>
                    <a href="#" class="view-all">Все новости</a>
                </div>
                
                <div class="news-grid">
                    @foreach([
                        ['category' => 'Общество', 'title' => 'В России запущена новая социальная программа поддержки семей', 'date' => 'Сегодня, 08:30'],
                        ['category' => 'Образование', 'title' => 'Школы переходят на обновленные образовательные стандарты', 'date' => 'Сегодня, 07:45'],
                        ['category' => 'Происшествия', 'title' => 'Экстренные службы ликвидировали крупное ДТП на трассе М4', 'date' => 'Вчера, 22:15'],
                        ['category' => 'Культура', 'title' => 'Открытие нового выставочного зала в историческом центре Москвы', 'date' => 'Вчера, 20:00'],
                        ['category' => 'В мире', 'title' => 'Международный саммит по климату: новые обязательства стран', 'date' => 'Вчера, 19:30'],
                        ['category' => 'Экономика', 'title' => 'Инфляция замедлилась до минимальных значений за последние 2 года', 'date' => 'Вчера, 17:45']
                    ] as $news)
                    <article class="news-card">
                        <img src="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                             alt="{{ $news['title'] }}" class="news-card__image">
                        <div class="news-card__content">
                            <span class="news-card__category">{{ $news['category'] }}</span>
                            <h3 class="news-card__title">{{ $news['title'] }}</h3>
                            <p class="news-card__excerpt">Краткое описание новости и основных моментов, которые будут интересны читателям...</p>
                            <div class="news-card__meta">
                                <span class="news-card__date">{{ $news['date'] }}</span>
                                <span class="news-card__views">856 просмотров</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Видеоновости -->
    <section class="news-section" style="background: var(--white); padding: 40px 0;">
        <div class="container">
            <div class="category-section">
                <div class="category-header">
                    <h2 class="category-title">Видеоновости</h2>
                    <a href="#" class="view-all">Все видео</a>
                </div>
                
                <div class="news-grid">
                    @foreach([
                        ['title' => 'Прямой эфир с пресс-конференции министра', 'views' => '15K'],
                        ['title' => 'Репортаж с места главного спортивного события', 'views' => '12K'],
                        ['title' => 'Интервью с известным ученым о новых открытиях', 'views' => '8K']
                    ] as $video)
                    <article class="news-card">
                        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                                 alt="{{ $video['title'] }}" 
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); 
                                      background: rgba(0,0,0,0.7); color: white; padding: 10px 20px; border-radius: 50%;">
                                ▶
                            </div>
                        </div>
                        <div class="news-card__content">
                            <span class="news-card__category">Видео</span>
                            <h3 class="news-card__title">{{ $video['title'] }}</h3>
                            <div class="news-card__meta">
                                <span class="news-card__date">2 часа назад</span>
                                <span class="news-card__views">{{ $video['views'] }} просмотров</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection