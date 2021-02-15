<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a href="{{ route('panel') }}">
            <img class="navbar-brand" src="/img/logo.svg" alt="Логотип" style="filter: invert(1)">
        </a>
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div id="navbarCollapse" class="collapse navbar-collapse">
        @if (Auth::user()->status === 'Администратор')
            <ul class="nav navbar-nav">
                <li><a href="{{ route('admin.lessons') }}">Учебные предметы</a></li>
                <li><a href="{{ route('admin.users') }}">Пользователи</a></li>
                <li><a href="{{ route('admin.groups') }}">Учебные группы</a></li>
            </ul>
        @endif
        <form class="navbar-form form-inline">
            <div class="input-group search-box">
                <input type="text" id="search" class="form-control" placeholder="Найти">
                <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
            </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="notifications"><i class="fa fa-bell-o"></i><span class="badge">1</span></a></li>
            <li><a href="#" class="messages"><i class="fa fa-envelope-o"></i><span class="badge">1</span></a></li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action"><img src="https://www.tutorialrepublic.com/examples/images/avatar/2.jpg" class="avatar" alt="Avatar">
                    {{ Auth::user()->getShortName() }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-user-o"></i> Профиль</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout"><i class="material-icons">&#xE8AC;</i> Выйти</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
