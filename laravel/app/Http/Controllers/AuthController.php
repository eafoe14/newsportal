<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function showRegister()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        // Проверяем данные
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,advertiser',
        ]);

        // Создаем пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'company_info' => $request->company_info,
        ]);

        // Авторизуем пользователя
        Auth::login($user);

        // Перенаправляем в зависимости от роли
        if ($user->isAdvertiser()) {
            return redirect('/advertiser/dashboard');
        }

        return redirect('/')->with('success', 'Регистрация успешна!');
    }

    // Показать форму входа
    public function showLogin()
    {
        return view('auth.login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        // Проверяем данные
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Пытаемся авторизовать
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Перенаправляем в зависимости от роли
            if (Auth::user()->isAdvertiser()) {
                return redirect('/advertiser/dashboard');
            }
            
            return redirect('/')->with('success', 'Вход выполнен!');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    // Выход
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}