@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<h1>Вход</h1>

<form method="POST" action="/login">
    @csrf
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn">Войти</button>
    
    <p>Нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
</form>
@endsection