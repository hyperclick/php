<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Контроллер, который отвечает за регистрацию в системе
 */
class RegisterController extends Controller
{
    /**
     * Встроеная логика регистрации в Ларавеле
     */
    use RegistersUsers;

    /**
     * Перенаправление после успешной регистрации
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Подключение посредников для контроллера
     * guest - определяет, чтобы пользователь был неавторизован при регистрации
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Валидация входных данных
     * required - обязательно для заполненич
     * string - строка
     * max:N - максимум N символов
     * email - тип email (проверка по регулярному выражению на соответствие почте)
     * unique:users - уникальное значение для таблицы users
     * confirmed - должно быть поле password_confirmation равное password
     * Rule:in - должно равняться одному из значений (student или teacher)
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'     => ['required', 'string', 'max:10', 'unique:users'],
            'password'  => ['required', 'string', 'min:3', 'confirmed'],
            'status'    => ['required', 'string', Rule::in(['student', 'teacher'])],
        ]);
    }

    /**
     * Метод, который создаёт нового пользователя по переданным данным
     * Хэш пароля создаётся внутренней логикой Ларавеля (относительно APP_KEY в .env)
     */
    protected function create(array $data)
    {
        return User::query()->create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'phone'     => $data['phone'],
            'status'    => $data['status'],
        ]);
    }
}
