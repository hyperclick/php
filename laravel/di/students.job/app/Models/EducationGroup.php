<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Учебные группы
 */
class EducationGroup extends Model
{
    protected $guarded = [];

    /**
     * Получить факультет, в который входит учебная группа
     */
    public function faculty()
    {
        return $this->belongsTo(EducationFaculty::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, UserGroup::class, 'group_id', 'id', 'id', 'user_id');
    }

    public static function getGroupsForAdmin()
    {
        return static::with('faculty')->get()->each(function ($group) {
            $group->place = $group->faculty->place->title;
            $group->count = $group->users->count();
            $group->facult = $group->faculty->title;
        })->toArray();
    }
}
