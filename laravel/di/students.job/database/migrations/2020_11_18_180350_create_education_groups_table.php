<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationGroupsTable extends Migration
{
    /**
     * Метод, который вызывается при запуске миграций
     * @return void
     */
    public function up()
    {
        # Создание таблицы в базе данных
        Schema::create('education_groups', function (Blueprint $table) {
            $table->id(); # ID группы
            $table->string('number'); # номер группы (строка, потому что некоторые вузы используют буквы)
            $table->unsignedBigInteger('faculty_id'); # ID факультета
            $table->timestamps(); # поля created_at (время создания записи) и updated_at (время обновления записи)
        });
    }

    /**
     * Метод, который вызывается при откате миграций
     * @return void
     */
    public function down()
    {
        # полное удаление таблицы из базы данных
        Schema::dropIfExists('education_groups');
    }
}
