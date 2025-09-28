<?php
// Пространство имен - способ организации кода
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Это метод (функция) который будет вызываться при заходе на главную
    public function index()
    {
        // Подготавливаем данные для страницы
        $pageData = [
            'title' => 'Главная страница',
            'welcome' => 'Добро пожаловать на наш сайт!',
            'features' => [
                'Быстрая работа',
                'Надежная платформа', 
                'Простота использования'
            ]
        ];
        
        // Возвращаем представление (view) с данными
        return view('home', $pageData);
    }
}