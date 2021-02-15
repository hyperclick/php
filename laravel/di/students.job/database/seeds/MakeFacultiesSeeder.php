<?php

use Illuminate\Database\Seeder;

class MakeFacultiesSeeder extends Seeder
{
    const TEST_DATA = [
        1 => [
            'Факультет технологий' => 'Технологии',
            'Разработчик веб-приложений' => 'Веб-программирование',
        ],
        2 => [
            'Факультет завоеваний' => 'Тактика',
            'Факультет единения сознания' => 'Инопланетаника',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TEST_DATA as $place_id => $faculty) {
            foreach ($faculty as $name => $direction) {
                DB::table('education_faculties')->insert([
                    'title' => $name,
                    'direction' => $direction,
                    'education_place_id' => $place_id,
                ]);
            }
        }
    }
}
