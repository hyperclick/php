@extends('layouts.project')

@prepend('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endprepend

@prepend('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endprepend

@section('content')
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>{{ $table['title'] ?? 'Заголовок' }}</h2>
                        </div>
                        <div class="col-xs-7">
                            @if(isset($table['button']))
                                <a href="{{ $table['button-link'] ?? '#' }}" class="btn btn-primary"><i class="material-icons">&#xE147;</i>
                                    <span>{{ $table['button'] }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        @foreach($table['header'] as $value)
                            <th>{{ $value }}</th>
                        @endforeach
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table['data'] as $entity)
                        <tr>
                            @foreach($table['header'] as $key => $header)
                                <td>
                                    @if($key === 'name' && isset($entity['photo']))
                                        <img src="/photos/{{ $entity['photo'] }}" class="avatar" alt="Avatar">
                                    @endif
                                    {{ $entity[$key] }}
                                </td>
                            @endforeach
                                <td>
                                    @if (isset($table['edit']))
                                        <a href="{{ $table['edit'] . $entity['id'] }}" class="settings" title="Редактировать" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                    @endif

                                    @if (isset($table['delete']))
                                            <a href="{{ $table['delete'] . $entity['id'] }}" class="delete" title="Удалить" data-toggle="tooltip" ><i class="material-icons">&#xE5C9;</i></a>
                                        @endif
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text"><b>Всего:</b> {{ count($table['data']) }}</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
