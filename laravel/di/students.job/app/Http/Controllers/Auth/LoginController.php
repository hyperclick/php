<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Контроллер, отвечающий за авторизацию в системе
 */
class LoginController extends Controller
{
    /**
     * Встроенная логика авторизации Ларавеля
     */
    use AuthenticatesUsers;

    /**
     * Перенаправление после успешной авторизации
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Устанавливается посредник на проверку, что пользователь не авторизован (кроме метода logout)
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
