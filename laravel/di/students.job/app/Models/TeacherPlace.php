<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель таблицы, которая связывает преподавателей и учебные заведения (многие ко многим)
 */
class TeacherPlace extends Model
{
    /**
     * Название таблицы, к которой относится данная модель
     */
    public $table = 'teacher_place';

    protected $guarded = [];
}
