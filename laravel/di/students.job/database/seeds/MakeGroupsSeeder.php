<?php

use Illuminate\Database\Seeder;

class MakeGroupsSeeder extends Seeder
{
    const TEST_DATA = [
        1 => [
            '81',
            '91',
            '92',
        ],
        2 => [
            '232',
            '231',
            '233',
            '234',
        ],
        3 => [
            '304a',
            '302b',
        ],
        4 => [
            '12300',
            '23023',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TEST_DATA as $faculty_id => $groups) {
            foreach ($groups as $group) {
                DB::table('education_groups')->insert([
                    'number' => $group,
                    'faculty_id' => $faculty_id,
                ]);
            }
        }
    }
}
