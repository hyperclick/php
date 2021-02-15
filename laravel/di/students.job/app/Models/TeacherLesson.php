<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель таблицы, которая связывает преподавателей и предметы (многие ко многим)
 */
class TeacherLesson extends Model
{
    /**
     * Имя таблицы, к которой относится эта модель
     */
    public $table = 'teacher_lesson';

    protected $guarded = [];
}
