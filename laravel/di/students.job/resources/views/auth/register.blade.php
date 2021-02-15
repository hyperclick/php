@extends('layouts.auth');

@section('title', 'Регистрация')

@section('content')
    <form action="/register" method="POST" class="form-horizontal">
        @csrf
        <div class="col-xs-8 col-xs-offset-4">
            <h2>Регистрация</h2>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="status">Я</label>
            <div class="col-xs-8">
                <select class="form-control" id="status" name="status">
                    <option value="student">Студент</option>
                    <option value="teacher" {{ (old('status') === 'teacher') ? 'selected' : ''}}>Преподаватель</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="name">Имя пользователя</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Похомович Евгений Викторович"
                       value="{{ old('name') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="email">Электронная почта</label>
            <div class="col-xs-8">
                <input type="email" class="form-control" id="email" name="email" placeholder="pevkit@mail.ru"
                       value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="phone">Телефон</label>
            <div class="col-xs-8">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="9211234567"
                       value="{{ old('phone') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="password">Пароль</label>
            <div class="col-xs-8">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="password_confirmation">Подтвердите пароль</label>
            <div class="col-xs-8">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-8 col-xs-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">Зарегистрироваться</button>
            </div>
        </div>
    </form>
    <div class="text-center">Уже есть аккаунт? <a href="/login">Залогиниться</a></div>
@endsection
