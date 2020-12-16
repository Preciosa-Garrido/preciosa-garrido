@extends('layouts.structure')

@section('title', 'Minha conta')

@section('css')

	<style type="text/css">
		a.link {padding: 20px; margin-bottom: 10px}
		div.alert {position: absolute; top: 150px; width: 80%; left: 100px;}
	</style>

@endsection

@section('content')
    
    @if(session('message'))
    	<div class="alert alert-success">{{ session('message') }}</div>
    @endif
    
	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container p_100">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{ asset('storage/users/'.auth()->user()->foto) }}" alt="">
						<div class="hover">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner reg_form">
						<h3>Perfil</h3><hr>
						<div class="text-justify p_l_40">
							<p>Primeiro nome: <span style="color: red">{{ auth()->user()->first_name }}</span></p>
							<p>Último nome: <span style="color: red">{{ auth()->user()->last_name }}</span></p>
							<p>E-mail: <span style="color: red">{{ auth()->user()->email }}</span></p>
							<p>Telefone: <span style="color: red">{{ auth()->user()->phone }}</span></p>
							<p>Morada: <span style="color: red">{{ auth()->user()->address }}</span></p>
						</div><hr>
						<a href="{{ route('user.edit') }}" class="link">Editar perfil</a> !! 
						<a href="{{ route('logout') }}" class="link">Terminar sessão</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

@stop