@extends('layouts.project')

@section('title', 'Список')

@section('content')
    <div class="container">
        <div class="table-wrapper" style="border: 1px solid #dadada; border-radius: 10px;">
            <div class="dropdown" style="display: inline-block;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Сортировка
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#sort-name" data-sort="name" onclick="sortData('name')">Имя</a></li>
                    <li><a href="#sort-status" data-sort="status" onclick="sortData('status')">Статус</a></li>
                    <li><a href="#sort-age" data-sort="age" onclick="sortData('age')">Возраст</a></li>
                </ul>
            </div>
            <div class="dropdown" style="display: inline-block;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Статус
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#filter-student" data-sort="name" onclick="filterData('status', 'Студент')">Студент</a></li>
                    <li><a href="#filter-teacher" data-sort="status" onclick="filterData('status', 'Преподаватель')">Преподаватель</a></li>
                </ul>
            </div>
                <table class="table table-striped sj-table" id="userTable">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Имя</th>
                        <th>Статус</th>
                        <th>Возраст</th>
                        <th>Учебное заведение</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
    </div>
@endsection

@prepend('hidden')
    <input type="hidden" id="data" value="{{ $users }}">
@endprepend

@prepend('scripts')
    <script src="/js/script.js"></script>
@endprepend
