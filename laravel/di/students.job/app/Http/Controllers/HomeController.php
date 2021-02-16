<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Основной контроллер системы
 */
class HomeController extends Controller
{
    /**
     * Устанавливается посдреник auth, проверяющий, что пользователь авторизован
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Метод, обрабатывающий открытие главной страницы
     */
    public function index()
    {
        # получение коллекции всех пользователей из БД и установка дополнительных свойств
        $users = User::query()->whereIn('status', ['teacher', 'student'])->get()->each(function($item) {
            $item->age = ($item->birthday) ? Carbon::parse($item->birthday)->age : '-';
            $item->places = implode(', ', $item->place()->map->toArray()->map->title_abbr->toArray());
        });
        
        # возвращаем страницу panel с передачей в неё переменной users
        return view('panel', compact('users'));
    }
}
