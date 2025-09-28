<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Показать форму подачи заявки
    public function create()
    {
        return view('applications.create');
    }

    // Сохранить заявку
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        Application::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'submitted_at' => now(),
        ]);

        return redirect('/my-applications')->with('success', 'Заявка успешно отправлена!');
    }

    // Мои заявки
    public function myApplications()
    {
        $applications = Auth::user()->applications()->latest()->get();
        return view('applications.my', compact('applications'));
    }

    // Все заявки (для рекламного отдела)
    public function index()
    {
        // Проверка роли
        if (Auth::user()->role !== 'advertiser') {
            abort(403, 'Доступ запрещен');
        }

        $applications = Application::with(['user', 'processor'])->latest()->get();
        return view('applications.index', compact('applications'));
    }

    // Панель управления рекламного отдела
    public function dashboard()
    {
        // Проверка роли
        if (Auth::user()->role !== 'advertiser') {
            abort(403, 'Доступ запрещен');
        }

        $stats = [
            'total' => Application::count(),
            'pending' => Application::where('status', 'pending')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        $recentApplications = Application::with('user')->latest()->take(5)->get();

        return view('applications.dashboard', compact('stats', 'recentApplications'));
    }

    // Обновить статус заявки
    public function updateStatus(Request $request, Application $application)
    {
        // Проверка роли
        if (Auth::user()->role !== 'advertiser') {
            abort(403, 'Доступ запрещен');
        }

        $application->update([
            'status' => $request->status,
            'admin_comment' => $request->admin_comment,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Статус заявки обновлен!');
    }
}