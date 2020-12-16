@php
    use App\Models\Notification;

    $count = array(
        'notifications' => Notification::all()->count(),
        'readNotifications' => Notification::whereStatus(1)->get()->count(),
        'unreadNotifications' => Notification::whereStatus(0)->get()->count(),
    );

    use App\Models\Chat;

    $chat = Chat::whereAdminId(auth('admin')->user()->id)->where('sender', '!=', 'admin')->whereStatus(0)->get()->count();
    $messages = Chat::whereAdminId(auth('admin')->user()->id)->where('sender', '!=', 'admin')->whereStatus(0)->get();

@endphp

<!DOCTYPE html>
<html>
    <head>
        <title>Preciosa Garrido » Admin » @yield('title')</title>
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
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/flat-orange.css') }}" />
        
        @yield('css')

        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    </head>

    <body class="flat-orange">
        <div class="app-container">
            <div class="row content-container">
                <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-expand-toggle">
                                <i class="fa fa-bars icon"></i>
                            </button>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">
                                    <a href="{{ route('admin.homepage') }}">
                                        <span>Admin</span>
                                    </a>
                                </li>
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
                                            <a href="{{ url('admin/chat/show/'.$message->user->id) }}">{{ $message->user->first_name }}</a>
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
                                            <a href="{{ route('admin.notifications.seen') }}">
                                                <li class="list-group-item">
                                                    <span class="badge">
                                                        {{ $count['readNotifications'] }}
                                                    </span>
                                                    <i class="fa fa-exclamation-circle icon"></i> Vistas
                                                </li>
                                            </a>
                                            <a href="{{ route('admin.notifications.notseen') }}">
                                                <li class="list-group-item">
                                                    <span class="badge success">
                                                        {{ $count['unreadNotifications'] }}
                                                    </span>
                                                    <i class="fa fa-check icon"></i> Não vistas
                                                </li>
                                            </a>
                                            <a href="{{ route('admin.notifications') }}">
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
                                    {{ auth('admin')->user()->name }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="profile-img">
                                        <!-- <img src="" class="profile-img"> -->
                                    </li>
                                    <li>
                                        <div class="profile-info">
                                            <h4 class="username">
                                                {{ auth('admin')->user()->username }}
                                            </h4>
                                            <p>{{ auth('admin')->user()->email }}</p>
                                            <div class="btn-group margin-bottom-2x" role="group">
                                                <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                                <a href="{{ route('admin.logout') }}" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
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
                                <a class="navbar-brand" href="{{ route('admin.homepage') }}">
                                    <div class="icon fa fa-paper-plane"></div>
                                    <div class="title">Preciosa admin</div>
                                </a>
                                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                    <i class="fa fa-times icon"></i>
                                </button>
                            </div>
                            <ul class="nav navbar-nav">
                                <li class="{{ Request::is('*home*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.homepage') }}">
                                        <span class="icon fa fa-tachometer"></span>
                                        <span class="title">Página inicial</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*chat*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.chat') }}">
                                        <span class="icon fa fa-user-md"></span>
                                        <span class="title">Chat</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('*clients*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.clientes.consultar') }}">
                                        <span class="icon fa fa-user-md"></span>
                                        <span class="title">Clientes</span>
                                    </a>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*parceiros*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-parceiros">
                                        <span class="icon fa fa-sitemap"></span><span class="title">Parceiros</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-parceiros" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('parceiros.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.parceiro.register') }}">Cadastrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*gestors*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-users">
                                        <span class="icon fa fa-users"></span><span class="title">Funcionários</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-users" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('gestors.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('gestor.register.form') }}">Cadastrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*categories*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-category">
                                        <span class="icon fa fa-book"></span><span class="title">Categorias</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-category" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('admin.category.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.category.register') }}">Registrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*products*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-product">
                                        <span class="icon fa fa-dropbox"></span><span class="title">Produtos</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-product" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('admin.products.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.products.register') }}">Registrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*promotions*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-promotion">
                                        <span class="icon fa fa-gift"></span><span class="title">Promoções</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-promotion" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('admin.promotion.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.promotion.register') }}">Registrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="panel panel-default dropdown {{ Request::is('*coupon*') ? 'active' : '' }}">
                                    <a data-toggle="collapse" href="#dropdown-coupon">
                                        <span class="icon fa fa-book"></span><span class="title">Cupões</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-coupon" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <a href="{{ route('coupon.consultar') }}">Listar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('coupon.register') }}">Registrar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="{{ Request::is('*sales*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sales') }}">
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
                                                    <a href="{{ route('admin.contacts') }}">Contactos</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.newsletter') }}">Newsletter</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="{{ Request::is('*license*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.license') }}">
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
        
        <!-- LINKs PARA FOLHAS DE SCRIPT EM JAVASCRIPT -->
	    <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
        <script src="{{ asset('admin/js/bootstrap-switch.min.js') }}"></script>

        <script src="{{ asset('admin/js/jquery.matchHeight-min.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/js/select2.full.min.js') }}"></script>

        <script src="{{ asset('admin/js/Chart.bundle.js') }}"></script>
        <script src="{{ asset('admin/js/Chart.init.js') }}"></script>
		
		<script src="{{ asset('admin/js/admin.js') }}"></script>
	</body>
</html>
