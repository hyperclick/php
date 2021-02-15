@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <form action="/login" method="POST" class="form-horizontal">
        @csrf
        <div class="col-xs-8 col-xs-offset-4">
            <h2>Авторизация</h2>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="email">Email</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4" for="password">Пароль</label>
            <div class="col-xs-8">
                <input type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-8 col-xs-offset-4">
                <p><label class="checkbox-inline"><input type="checkbox" name="remember"> Запомнить меня</label></p>
                <button type="submit" class="btn btn-primary btn-lg">Войти</button>
            </div>
        </div>
    </form>
    <div class="text-center">Нет аккаунта? <a href="/register">Зарегистрироваться</a></div>
@endsection
