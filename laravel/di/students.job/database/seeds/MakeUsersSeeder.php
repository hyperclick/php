<?php

use Illuminate\Database\Seeder;

class MakeUsersSeeder extends Seeder
{
    const TEST_DATA = [
        'student' => [
            'Петров Иван Егорович' => [
                'email' => 'student_1@project.test',
                'phone' => '9111234567',
                'photo' => '1.jpg',
                'birthday' => '1994-01-01',
            ],
            'Иванов Петр Егорович' => [
                'email' => 'student_2@project.test',
                'phone' => '9111234565',
                'photo' => '2.jpg',
                'birthday' => '1996-01-01',
            ],
            'Егоров Иван Петрович' => [
                'email' => 'student_3@project.test',
                'phone' => '9111234566',
                'photo' => '3.jpg',
                'birthday' => '1998-01-01',
            ],
        ],
        'teacher' => [
            'Александрова Валентина Евгеньевна' => [
                'email' => 'teacher_1@project.test',
                'phone' => '9811234565',
                'photo' => '4.jpg',
                'birthday' => '1956-01-01',
            ],
            'Валентинова Александра Евгеньевна' => [
                'email' => 'teacher_2@project.test',
                'phone' => '9811234566',
                'photo' => '5.jpg',
                'birthday' => '1986-01-01',
            ],
            'Евгеньева Александра Валентиновна' => [
                'email' => 'teacher_3@project.test',
                'phone' => '9811234567',
                'photo' => '6.jpg',
                'birthday' => '1945-01-01',
            ],
        ],
        'admin' => [
            'Похомович Евгений Викторович' => [
                'email' => 'pevkit@mail.ru',
                'phone' => '1234567890',
                'photo' => '7.jpg',
                'birthday' => '1823-01-01',
            ]
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TEST_DATA as $status => $group) {
            foreach ($group as $name => $user) {
                DB::table('users')->insert([
                    'name' => $name,
                    'email' => $user['email'],
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'phone' => $user['phone'],
                    'status' => $status,
                    'photo' => $user['photo'],
                    'birthday' => $user['birthday'],
                ]);

                $user = \App\Models\User::query()->firstWhere('email', $user['email']);

                switch ($status) {
                    case 'student':
                        DB::table('user_group')->insert([
                            'user_id' => $user->id,
                            'group_id' => rand(1, 11),
                        ]);
                        break;
                    case 'teacher':
                        DB::table('teacher_place')->insert([
                           'user_id' => $user->id,
                           'education_place_id' => rand(1,2),
                        ]);
                        DB::table('teacher_lesson')->insert([
                            'user_id' => $user->id,
                            'lesson_id' => rand(1,5),
                        ]);
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
