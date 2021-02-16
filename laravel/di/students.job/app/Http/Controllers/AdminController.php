<?php

namespace App\Http\Controllers;

use App\Models\EducationGroup;
use App\Models\EducationPlace;
use App\Models\EducationFaculty;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public const USER_INFO = [
        'name' => ['category' => 'input', 'type' => 'text', 'required' => true, 'label' => 'Имя пользователя'],
        'email' => ['category' => 'input', 'type' => 'email', 'required' => true, 'label' => 'Электронная почта'],
        'password' => ['category' => 'input', 'type' => 'password', 'required' => true, 'label' => 'Пароль'],
        'password_confirmation' => ['category' => 'input', 'type' => 'password', 'required' => true, 'label' => 'Подтвердите пароль'],
        'phone' => ['category' => 'input', 'type' => 'tel', 'required' => true, 'label' => 'Телефон пользователя'],
        'status' => ['category' => 'select', 'required' => true, 'label' => 'Статус пользователя', 'options' => [
            'student' => 'Студент',
            'teacher' => 'Преподаватель',
            'admin' => 'Администратор',
        ]],
    ];

    public const LESSON_INFO = [
        'title' => ['category' => 'input', 'type' => 'text', 'required' => true, 'label' => 'Предмет'],
    ];

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function users()
    {
        $table = [
            'delete' => '/admin/users/delete/',
            'edit' => '/admin/users/edit/',
            'header' => [
                'id' => 'ID',
                'name' => 'Имя пользователя',
                'email' => 'Email',
                'birthday' => 'Дата рождения',
                'phone' => 'Телефон',
                'status' => 'Статус',
            ],
            'title' => 'Пользователи',
            'button' => 'Добавить пользователя',
            'button-link' => '/admin/users/add',
            'data' => User::query()->select('id', 'name', 'email', 'birthday', 'phone', 'status', 'photo')
                ->get()->whereNotIn('id', [Auth::user()->id])->toArray(),
        ];

        return view('admin.table', compact('table'));
    }

    public function lessons()
    {
        $table = [
            'header' => [
                'id' => 'ID',
                'title' => 'Название предмета',
            ],
            'title' => 'Предметы',
            'data' => Lesson::query()->select('id', 'title')->get()->toArray(),
            'delete' => '/admin/lessons/delete/',
            'edit' => '/admin/lessons/edit/',
            'button' => 'Добавить предмет',
            'button-link' => '/admin/lessons/add',
        ];

        return view('admin.table', compact('table'));
    }

    public function groups()
    {
        $table = [
            'header' => [
                'id' => 'ID',
                'place' => 'Учебное заведение',
                'facult' => 'Факультет',
                'number' => 'Номер группы',
                'count' => 'Количество студентов',
            ],
            'title' => 'Учебные группы',
            'data' => EducationGroup::getGroupsForAdmin(),
            'edit' => '/admin/groups/edit/',
        ];

        return view('admin.table', compact('table'));
    }

    public function editGroupPage(int $group)
    {
        $group = EducationGroup::find($group);
        $students = $group->users;
        $faculty = $group->faculty;
        $place = $faculty->place;
        // $places = EducationPlace::all()->map->title->toArray();
        $places = EducationPlace::all()->mapWithKeys(function($p){return [$p->id=>$p->title];})->toArray();
        $faculties = EducationFaculty::all();

        return view('admin.groups.edit', compact('group', 'students', 'faculty', 'place', 'places', 'faculties'));
    }

    public function editGroup(Request $request, int $group_id)
    {
        EducationGroup::query()->find($group_id)->update($request->all());

        return redirect()->route('admin.groups');
    }

    public function deleteUser(int $user_id)
    {
        User::destroy($user_id);

        return redirect()->back();
    }

    public function addUserPage()
    {
        $structure = [
            'info' => static::USER_INFO,
            'method' => '/admin/users/add',
            'button' => 'Добавить',
        ];

        return view('admin.edit', compact('structure'));
    }

    public function editUserPage(int $user_id)
    {
        $user = User::query()->find($user_id);
        $structure = [
            'info' => Arr::except(static::USER_INFO, ['password', 'password_confirmation']),
            'data' => $user->toArray(),
            'method' => '/admin/users/edit/' . $user_id,
            'button' => 'Изменить',
        ]; 
        
         
        $structure['info']['status']['selected'] = $user->OriginalStatus();  
        // dd($user->OriginalStatus());
        // dd($structure);

        return view('admin.edit', compact('structure'));
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::query()->create($data);

        return redirect()->route('admin.users');
    }

    public function editUser(Request $request, int $user)
    {
        User::query()->find($user)->update($request->all());

        return redirect()->route('admin.users');
    }

    public function deleteLesson(int $lesson_id)
    {
        Lesson::destroy($lesson_id);

        return redirect()->back();
    }

    public function addLessonPage()
    {
        $structure = [
            'info' => static::LESSON_INFO,
            'method' => '/admin/lessons/add',
            'button' => 'Добавить',
        ];

        return view('admin.edit', compact('structure'));
    }

    public function editLessonPage(int $lesson_id)
    {
        return $this->openPage(static::LESSON_INFO, Lesson::query()->find($lesson_id)->toArray(), '/admin/lessons/edit/' . $lesson_id, 'Изменить');
    }

    public function addLesson(Request $request)
    {
        Lesson::query()->create($request->all());

        return redirect()->route('admin.lessons');
    }

    public function editLesson(Request $request, int $lesson_id)
    {
        Lesson::query()->find($lesson_id)->update($request->all());

        return redirect()->route('admin.lessons');
    }

    protected function openPage(array $info, array $data, string $method, string $button)
    {
        $structure = [
            'info' => $info,
            'data' => $data,
            'method' => $method,
            'button' => $button,
        ];

        return view('admin.edit', compact('structure'));
    }
}
