<?php

use Illuminate\Support\Facades\Route;

# Общие запросы
Auth::routes(); # маршруты авторизации
Route::get('logout', 'Auth\LoginController@logout'); # GET маршрут для выхода
Route::get('/', 'HomeController@index')->name('panel'); # Главная панель приложения

# Запросы для админки
Route::prefix('admin')->group(function(){
    # Админка: пользователи
    Route::prefix('users')->group(function(){
        # Список пользователей
        Route::get('/', 'AdminController@users')->name('admin.users');
        # Удаление пользователя
        Route::get('delete/{user}', 'AdminController@deleteUser')->name('admin.users.delete');
        # Добавление пользователя
        Route::get('add', 'AdminController@addUserPage')->name('admin.users.add-page');
        # Редактирование пользователя
        Route::get('edit/{user}', 'AdminController@editUserPage')->name('admin.users.edit-page');

        # POST запросы для создания/редактирования
        Route::post('add', 'AdminController@addUser')->name('admin.users.add');
        Route::post('edit/{user}', 'AdminController@editUser')->name('admin.users.edit');
    });

    # Админка: предметы
    Route::prefix('lessons')->group(function(){
        Route::get('/', 'AdminController@lessons')->name('admin.lessons');
        Route::get('delete/{lesson}', 'AdminController@deleteLesson')->name('admin.lessons.delete');
        Route::get('add', 'AdminController@addLessonPage')->name('admin.lessons.add-page');
        Route::get('edit/{lesson}', 'AdminController@editLessonPage')->name('admin.lessons.edit-page');
        Route::post('add', 'AdminController@addLesson')->name('admin.lessons.add');
        Route::post('edit/{lesson}', 'AdminController@editLesson')->name('admin.lessons.edit');
    });

    Route::prefix('groups')->group(function() {
        Route::get('/', 'AdminController@groups')->name('admin.groups');
        Route::get('edit/{group}', 'AdminController@editGroupPage')->name('admin.groups.edit-page');
        Route::post('edit/{group}', 'AdminController@editGroup')->name('admin.groups.edit');
    });
});
