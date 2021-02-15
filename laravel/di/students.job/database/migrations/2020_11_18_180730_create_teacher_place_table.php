<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_place', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); # ID преподавателя
            $table->unsignedBigInteger('education_place_id'); # ID учебного заведения
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_place');
    }
}
