<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель таблицы, которая связывает пользователей (студентов) и учебные группы (многие ко многим)
 */
class UserGroup extends Model
{
    /**
     * Имя таблицы, к которой относится данная модель
     */
    public $table = 'user_group';

    protected $guarded = [];
}
