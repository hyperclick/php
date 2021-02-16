@extends('layouts.project')

@prepend('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endprepend

@section('content')
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">

                    @include('components.form.select', ['name' => 'place', 'required' => true, 'label' => 'Учебное заведение',  'options' => $places, 'selected' => $place->id ])
                <form action="/admin/groups/edit/{{ $group->id }}" method="POST">
                    @csrf


                    
                    @include('components.form.select', ['name' => 'faculty_id', 'required' => true, 'label' => 'Факультет', 'options' => [], 'selected' =>$faculty->id ])

                    @include('components.form.input', ['name' => 'number', 'required' => true, 'label' => 'Номер группы', 'type' => 'text', 'value' => $group->number])

                    Студенты

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
@prepend('hidden')
    <input type="hidden" id="selected_faculty_id" value="{{ $faculty->id }}">
@endprepend

@prepend('scripts')
    <script src="/js/admin/group/edit.js"></script>
@endprepend
