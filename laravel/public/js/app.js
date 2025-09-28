// Управление мобильным меню
class MobileMenu {
    constructor() {
        this.menuToggle = document.querySelector('.menu-toggle');
        this.mobileMenu = document.querySelector('.mobile-menu');
        this.menuClose = document.querySelector('.mobile-menu__close');
        this.searchToggle = document.querySelector('.search-toggle');
        this.searchBar = document.querySelector('.search-bar');
        
        this.init();
    }
    
    init() {
        // Открытие/закрытие мобильного меню
        this.menuToggle.addEventListener('click', () => {
            this.toggleMobileMenu();
        });
        
        this.menuClose.addEventListener('click', () => {
            this.closeMobileMenu();
        });
        
        // Закрытие меню при клике на ссылку
        this.mobileMenu.querySelectorAll('.mobile-nav__link, .mobile-auth__link, .mobile-user__link').forEach(link => {
            link.addEventListener('click', () => {
                this.closeMobileMenu();
            });
        });
        
        // Поиск
        this.searchToggle.addEventListener('click', () => {
            this.toggleSearch();
        });
        
        // Закрытие меню при клике вне его
        document.addEventListener('click', (e) => {
            if (this.mobileMenu.classList.contains('mobile-menu--open') && 
                !this.mobileMenu.contains(e.target) && 
                !this.menuToggle.contains(e.target)) {
                this.closeMobileMenu();
            }
        });
        
        // Закрытие поиска при клике вне его
        document.addEventListener('click', (e) => {
            if (this.searchBar.classList.contains('search-bar--open') && 
                !this.searchBar.contains(e.target) && 
                !this.searchToggle.contains(e.target)) {
                this.closeSearch();
            }
        });
        
        // Закрытие выпадающих меню при клике вне их
        this.initDropdowns();
        
        // Инициализация дополнительного функционала
        this.initNewsCards();
        this.updateDateTime();
    }
    
    initDropdowns() {
        // Закрытие выпадающего меню рубрик при клике вне его
        document.addEventListener('click', (e) => {
            const dropdown = document.querySelector('.nav-dropdown');
            const menu = document.querySelector('.nav-dropdown__menu');
            
            if (dropdown && menu && !dropdown.contains(e.target)) {
                this.closeDropdown(menu);
            }
        });
        
        // Закрытие меню пользователя при клике вне его
        document.addEventListener('click', (e) => {
            const userMenu = document.querySelector('.user-menu');
            const userDropdown = document.querySelector('.user-menu__dropdown');
            
            if (userMenu && userDropdown && !userMenu.contains(e.target)) {
                this.closeDropdown(userDropdown);
            }
        });
        
        // Обработка кликов по выпадающим меню
        const dropdownToggle = document.querySelector('.nav-dropdown__toggle');
        const userToggle = document.querySelector('.user-menu__toggle');
        
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const menu = document.querySelector('.nav-dropdown__menu');
                this.toggleDropdown(menu);
            });
        }
        
        if (userToggle) {
            userToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = document.querySelector('.user-menu__dropdown');
                this.toggleDropdown(dropdown);
            });
        }
    }
    
    toggleDropdown(dropdown) {
        if (dropdown) {
            const isOpen = dropdown.style.opacity === '1';
            if (isOpen) {
                this.closeDropdown(dropdown);
            } else {
                this.openDropdown(dropdown);
            }
        }
    }
    
    openDropdown(dropdown) {
        if (dropdown) {
            dropdown.style.opacity = '1';
            dropdown.style.visibility = 'visible';
            dropdown.style.transform = 'translateY(0)';
        }
    }
    
    closeDropdown(dropdown) {
        if (dropdown) {
            dropdown.style.opacity = '0';
            dropdown.style.visibility = 'hidden';
            dropdown.style.transform = 'translateY(-10px)';
        }
    }
    
    toggleMobileMenu() {
        this.mobileMenu.classList.toggle('mobile-menu--open');
        document.body.style.overflow = this.mobileMenu.classList.contains('mobile-menu--open') ? 'hidden' : '';
        
        // Анимация кнопки меню
        this.menuToggle.classList.toggle('menu-toggle--open');
    }
    
    closeMobileMenu() {
        this.mobileMenu.classList.remove('mobile-menu--open');
        this.menuToggle.classList.remove('menu-toggle--open');
        document.body.style.overflow = '';
    }
    
    toggleSearch() {
        this.searchBar.classList.toggle('search-bar--open');
        if (this.searchBar.classList.contains('search-bar--open')) {
            this.searchBar.querySelector('.search-input').focus();
        }
    }
    
    closeSearch() {
        this.searchBar.classList.remove('search-bar--open');
    }
    
    initNewsCards() {
        // Добавляем обработчики для карточек новостей
        document.querySelectorAll('.news-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.tagName !== 'A') {
                    // Здесь можно добавить переход на страницу новости
                    console.log('Переход на страницу новости');
                }
            });
        });
    }
    
    updateDateTime() {
        // Обновление даты в реальном времени
        function updateTime() {
            const now = new Date();
            const dateElements = document.querySelectorAll('.date');
            if (dateElements.length > 0) {
                dateElements.forEach(element => {
                    element.textContent = now.toLocaleDateString('ru-RU', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                });
            }
        }
        
        updateTime();
        setInterval(updateTime, 60000); // Обновлять каждую минуту
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    new MobileMenu();
    
    // Анимация появления элементов при скролле
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Наблюдаем за карточками новостей
    document.querySelectorAll('.news-card, .side-news').forEach(card => {
        observer.observe(card);
    });
});