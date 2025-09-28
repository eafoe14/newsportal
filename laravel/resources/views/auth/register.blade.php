@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<h1>Регистрация</h1>

<form method="POST" action="/register">
    @csrf
    
    <div class="form-group">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div class="form-group">
        <label for="password_confirmation">Подтвердите пароль:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    
    <div class="form-group">
        <label for="role">Я хочу:</label>
        <select id="role" name="role" required>
            <option value="user">Подать заявку на рекламу</option>
            <option value="advertiser">Работать в рекламном отделе</option>
        </select>
    </div>
    
    <div id="advertiser-fields" style="display: none;">
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
        </div>
        
        <div class="form-group">
            <label for="company_info">Информация о компании:</label>
            <textarea id="company_info" name="company_info">{{ old('company_info') }}</textarea>
        </div>
    </div>
    
    <button type="submit" class="btn">Зарегистрироваться</button>
    
    <p>Уже есть аккаунт? <a href="/login">Войти</a></p>
</form>

<script>
document.getElementById('role').addEventListener('change', function() {
    const advertiserFields = document.getElementById('advertiser-fields');
    if (this.value === 'advertiser') {
        advertiserFields.style.display = 'block';
    } else {
        advertiserFields.style.display = 'none';
    }
});
</script>
@endsection