<?php

use Illuminate\Database\Seeder;

class MakeLessonsSeeder extends Seeder
{
    const TEST_DATA = [
        'Математика',
        'Физика',
        'Биология',
        'Программирование',
        'Английский',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TEST_DATA as $subject) {
            DB::table('lessons')->insert([
                'title' => $subject,
            ]);
        }
    }
}
