<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Факультеты учебных заведений
 */
class EducationFaculty extends Model
{
    protected $guarded = [];

    /**
     * Получить учебное заведение, к которому относится данный факультет
     */
    public function place()
    {
        return $this->belongsTo(EducationPlace::class, 'education_place_id', 'id');
    }
}
