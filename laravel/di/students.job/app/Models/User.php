<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Модель для таблицы пользователей
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Возможные статусы пользователей
     */
    public $statuses = [
        'student' => 'Студент',
        'teacher' => 'Преподаватель',
        'admin' => 'Администратор',
    ];

    /**
     * Поля в таблице, доступные для массового заполнения через передачу данных в массиве
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'phone',
        'photo',
        'additional',
        'status',
    ];

    /**
     * Скрытые поля, которые не нужно возвращать при получении экземпляра модели
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birthday' => 'datetime:d.m.Y'
    ];

    /**
     * Аксессор - корректировка вывода поля статуса
     */
    public function getStatusAttribute($value)
    {
        return $this->statuses[$value];
    }
    public function OriginalStatus()
    {
        return $this->attributes['status'];
    }

    public function getPhotoAttribute($value)
    {
        return is_null($value) ? 'user.png' : $value;
    }

    /**
     * Получить предметы, которые ведёт преподаватель (1 к многим)
     */
    public function lesson()
    {
        return $this->hasManyThrough(Lesson::class, TeacherLesson::class, 'user_id', 'id', 'id', 'lesson_id');
    }

    /**
     * Получить учебное заведение пользователя (студента или преподавателя)
     */
    public function place()
    {
        if ('Преподаватель' === $this->status) {
            return $this->educationPlace;
        } else {
            return $this->groups->map->faculty->map->place;
        }
    }

    /**
     * Получить учебное заведение для преподавателя
     */
    public function educationPlace()
    {
        return $this->hasManyThrough(EducationPlace::class, TeacherPlace::class, 'user_id', 'id', 'id', 'education_place_id');
    }

    /**
     * Получить группы, к которым относится студент
     */
    public function groups()
    {
        return $this->hasManyThrough(EducationGroup::class, UserGroup::class, 'user_id', 'id', 'id', 'group_id');
    }

    /**
     * Метод для получения фамилии и инициалов пользователя
     */
    public function getShortName()
    {
        $name = explode(' ', $this->name);

        return $name[0] . ' ' . mb_substr($name[1], 0, 1, 'utf-8') . '.' . mb_substr($name[2], 0, 1, 'utf-8') . '.';
    }
}
