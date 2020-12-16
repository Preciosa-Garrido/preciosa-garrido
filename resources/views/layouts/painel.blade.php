@php
    use App\Models\Notification;

    $count = array(
        'notifications' => Notification::all()->count(),
        'readNotifications' => Notification::whereStatus(1)->get()->count(),
        'unreadNotifications' => Notification::whereStatus(0)->get()->count(),
    );

    use App\Models\Chat;

    $chat = Chat::whereGestorId(auth('gestor')->user()->id)->where('sender', '!=', 'gestor')->whereStatus(0)->get()->count();
    $messages = Chat::whereGestorId(auth('gestor')->user()->id)->where('sender', '!=', 'gestor')->whereStatus(0)->get();

@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>Preciosa Garrido » Painel » @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="img/favicon.png" type="image/png">

        <!-- LINKs PARA FOLHAS DE ESTILO CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/animate.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-switch.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/checkbox3.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/jquery.dataTables.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/dataTables.bootstrap.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.css') }}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/admin.css') }}" />

        <!-- THEMES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/flat-blue.css') }}" />
    </head>

    <body class="flat-blue">
        <div class="app-container">
            <div class="row content-container">
                <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-expand-toggle">
                                <i class="fa fa-bars icon"></i>
                            </button>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Painel</li>
                                @yield('breadcrumb')
                            </ol>
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-th icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-comments-o"></i>
                                    {{ $chat }}
                                </a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="title">
                                        Mensagens <span class="badge pull-right">{{ $chat }}</span>
                                    </li>
                                    <li class="message">
                                        @forelse($messages as $message)
                                            <a href="{{ url('painel/chat/show/'.$message->user->id) }}">{{ $message->user->first_name }}</a>
                                        @empty
                                            Não há mensagens recentes
                                        @endforelse
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown danger">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-star-half-o"> {{ $count['unreadNotifications'] }}</i>
                                </a>
                                <ul class="dropdown-menu danger  animated fadeInDown">
                                    <li class="title">
                                        Notificações
                                    </li>
                                    <li>
                                        <ul class="list-group notifications">
                                            <a href="{{ route('notifications.seen') }}">
                                                <li class="list-group-item">
                                                    <span class="badge">
                                                        {{ $count['readNotifications'] }}
                                                    </span>
                                                    <i class="fa fa-exclamation-circle icon"></i> Vistas
                                                </li>
                                            </a>
                                            <a href="{{ route('notifications.notseen') }}">
                                                <li class="list-group-item">
                                                    <span class="badge success">
                                                        {{ $count['unreadNotifications'] }}
                                                    </span>
                                                    <i class="fa fa-check icon"></i> Não vistas
                                                </li>
                                            </a>
                                            <a href="{{ route('notifications') }}">
                                                <li class="list-group-item message">
                                                    ver todas
                                                </li>
                                            </a>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ auth('gestor')->user()->name }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="profile-img">
                                        <!-- <img src="" class="profile-img"> -->
                                    </li>
                                    <li>
                                        <div class="profile-info">
                                            <h4 class="username">
                                                {{ auth('gestor')->user()->username }}
                                            </h4>
                                            <p>{{ auth('gestor')->user()->email }}</p>
                                            <div class="btn-group margin-bottom-2x" role="group">
                                                <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                                <a href="{{ route('gestor.logout') }}" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="side-menu sidebar-inverse">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="side-menu-container">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="{{ route('painel.homepage') }}">
                                    <div class="icon fa fa-paper-plane"></div>
                                    <div class="title">Preciosa admin</div>
                                </a>
                                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                    <i class="fa fa-times icon"></i>
                                </button>
                            </div>
                            <ul class="nav navbar-nav">
                                <li class="{{ Request::is('*painel') ? 'active' : Request::is('*home*') ? 'active' : '' }}">
                                    <a href="{{ route('painel.homepage') }}">
                                        <span class="icon fa fa-tachometer"></span><span class="title">Página inicial</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*chat*') ? 'active' : '' }}">
                                    <a href="{{ route('gestor.chat') }}">
                                        <span class="icon fa fa-user-md"></span>
                                        <span class="title">Chat</span>
                                    </a>
                                </li>

                                <li class="{{ Request::is('*clients*') ? 'active' : '' }}">
                                    <a href="{{ route('clientes.consultar') }}">
                                        <span class="icon fa fa-user-md"></span>
                                        <span class="title">Clientes</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*products*') ? 'active' : '' }}">
                                    <a href="{{ route('products.consultar') }}">
                                        <span class="icon fa fa-dropbox"></span>
                                        <span class="title">Ver produtos</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*promotions*') ? 'active' : '' }}">
                                    <a href="{{ route('promotion.consultar') }}">
                                        <span class="icon fa fa-gift"></span>
                                        <span class="title">Ver promoções</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*sales*') ? 'active' : '' }}">
                                    <a href="{{ route('sales') }}">
                                        <span class="icon fa fa-tags"></span>
                                        <span class="title">Ver vendas</span>
                                    </a>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*contacts*') ? 'active' : Request::is('*newsletter*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-others">
                                        <span class="icon fa fa-cog"></span><span class="title">Outros</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-others" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('painel.contacts') }}">Contactos</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('painel.newsletter') }}">Newsletter</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="{{ Request::is('*license*') ? 'active' : '' }}">
                                    <a href="{{ route('license') }}">
                                        <span class="icon fa fa-thumbs-o-up"></span><span class="title">Licença</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="container-fluid">
                    <div class="side-body padding-top" id="app">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer class="app-footer">
                <div class="wrapper">
                    <span class="pull-right">By Dorivaldo Valentim <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © <script>document.write(new Date().getFullYear());</script> Copyright.
                </div>
            </footer>
        </div>
		
        <script src="{{ asset('js/app.js') }}"></script>
		
        <!-- LINKs PARA FOLHAS DE SCRIPT EM JAVASCRIPT -->
		<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
		<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('admin/js/Chart.min.js') }}"></script>
		<script src="{{ asset('admin/js/bootstrap-switch.min.js') }}"></script>

		<script src="{{ asset('admin/js/jquery.matchHeight-min.js') }}"></script>
		<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('admin/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.min.js') }}"></script>
		<script src="{{ asset('admin/js/select2.full.min.js') }}"></script>

		<script src="{{ asset('admin/js/Chart.bundle.js') }}"></script>
		<script src="{{ asset('admin/js/Chart.init.js') }}"></script>
		
		<script src="{{ asset('admin/js/admin.js') }}"></script>
	</body>
</html>
