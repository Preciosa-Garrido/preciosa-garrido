@extends('layouts.admin')

@section('title', 'Página inicial')

@section('breadcrumb')

    <li>
        <span>Página inicial</span>
    </li>

@endsection

@section('content')

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('gestors.consultar') }}">
                        <div class="card red summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-user fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['gestors'] }}</div>
                                    <div class="sub-title">Funcionários</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.clientes.consultar') }}">
                        <div class="card yellow summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-users fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['users'] }}</div>
                                    <div class="sub-title">Consumidores</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{route('admin.sales') }}">
                        <div class="card green summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-tags fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['sales'] }}</div>
                                    <div class="sub-title">Vendas</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.products.consultar') }}">
                        <div class="card blue summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-dropbox fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['products'] }}</div>
                                    <div class="sub-title">Produtos</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('parceiros.consultar') }}">
                        <div class="card red summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-group fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['parceiros'] }}</div>
                                    <div class="sub-title">Parceiros</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ route('admin.contacts') }}">
                        <div class="card yellow summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-phone fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['contacts'] }}</div>
                                    <div class="sub-title">Contactos</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="card green summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-tags fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['sales'] }}</div>
                                    <div class="sub-title">Vendas</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="card blue summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-dropbox fa-4x"></i>
                                <div class="content">
                                    <div class="title">{{ $data['products'] }}</div>
                                    <div class="sub-title">Produtos</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

@stop