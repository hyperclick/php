<?php

//namespace database\seeds;

use Illuminate\Database\Seeder;

class MakePlacesSeeder extends Seeder
{
    const TEST_DATA = [
        'СПбКИТ' => [
            'title' => 'Колледж информационных технологий',
            'address' => 'Улица такая-то, дом 12'
        ],
        'СПбКЕТ' => [
            'title' => 'Колледж енопланетных технологий',
            'address' => 'Планета Марс, улица Прищельская, дом 13',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TEST_DATA as $abbr => $place) {
            DB::table('education_places')->insert([
                'title' => $place['title'],
                'title_abbr' => $abbr,
                'address' => $place['address'],
            ]);
        }
    }
}
