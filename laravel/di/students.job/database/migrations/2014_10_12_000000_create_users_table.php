<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Запуск миграции
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); # ID пользователя
            $table->string('name'); # ФИО
            $table->string('email')->unique(); # Электронный адрес
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); # Пароль
            $table->date('birthday')->nullable(); # Дата рождения
            $table->string('phone', 10)->unique(); # Телефон
            $table->string('photo')->nullable(); # Фото профиля
            $table->text('additional')->nullable(); # Другая инфо
            $table->enum('status', ['student', 'teacher', 'admin'])->default('student'); # статус пользователя
            $table->rememberToken(); # Токен "Запомнить меня"
            $table->timestamps(); # Временные метки
        });
    }

    /**
     * Откат миграции
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
