@extends('layouts.project')

@prepend('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endprepend

@section('content')
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <form action="{{ $structure['method'] }}" method="POST">
                    @csrf

                    @foreach($structure['info'] as $name => $element)
                        @include('components.form.' . $element['category'], ['name' => $name,'required' => $element['required']
                        ,'label' => $element['label']
                        ,'type' => $element['type'] ?? null
                        ,'options'  => $element['options'] ?? null
                        ,'selected' => $element['selected']??null
                        ,'value' => (isset($structure['data']) && isset($structure['data'][$name])) ? $structure['data'][$name] : null,])
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">{{ $structure['button'] }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
