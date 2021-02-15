@extends('layouts.project')

@prepend('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endprepend

@section('content')
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">

                <form action="/admin/groups/edit/{{ $group->id }}" method="POST">
                    @csrf

                    @include('components.form.input', ['name' => 'number', 'required' => true, 'label' => 'Номер группы', 'type' => 'text', 'value' => $group->number])


                    @include('components.form.select', ['name' => 'place', 'required' => true, 'label' => 'Учебное заведение', 'value' => $place->title, 'options' => $places, 'selected' => $place->id ])
                    
                    Факультет
                    {{ $faculty->title }}

                    Студенты
                    {{dd($students)}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@prepend('hidden')
    <input type="hidden" id="data" value="{{ $faculties }}">
@endprepend

@prepend('scripts')
    <script src="/js/admin/group/edit.js"></script>
@endprepend
