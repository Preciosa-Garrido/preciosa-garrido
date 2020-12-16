@extends('layouts.structure')

@section('title', 'Login')

@section('content')

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{ asset('img/login.jpg') }}" alt="">
						<div class="hover">
							<h4>Crie a sua conta</h4>
                            <p>Crie uma conta e disfrute de todos os recursos que a nossa loja oferece</p>
							<a class="main_btn" href="{{ route('register') }}">Criar conta</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h2>Iniciar sessão</h2><hr>
						<form class="row login_form" action="{{ route('login') }}" method="post">
							{{ csrf_field() }}
							<div class="col-md-12 form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required />

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="col-md-12 form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Palavra-passe" required />

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label for="remember">Manter-me autenticado</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="btn submit_btn">Iniciar sessão</button>
								<a href="#">Esquceste-te da tua palavra-passe</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

@stop