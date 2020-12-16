<!doctype html>
<html lang="pt">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>Preciosa Garrido » @yield('title')</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/linericon.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/simpleLightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
	<!-- main css -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

	@yield('css')
</head>

<body>

	<div id="app">
		<!--================Header Menu Area =================-->
		<header class="header_area">
			<div class="top_menu row m0">
				<div class="container-fluid">
					<div class="float-left">
						<p>Contacte-nos: (+244) 9XX XXX XXX</p>
					</div>
					<div class="float-right">
						<ul class="right_side">
							@auth
								<li>
									<a href="{{ route('mysales') }}">
										Minhas compras
									</a>
								</li>
								<li>
									<a href="{{ route('myaccount') }}">
										{{ auth()->user()->first_name }}
										{{ auth()->user()->last_name }}
									</a>
								</li>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                                        {{ __('Logout') }}
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>
							@else
								<li>
									<a href="{{ route('login') }}">
										Iniciar sessão
									</a>
								</li>
								<li>
									<a href="{{ route('register') }}">
										Criar conta
									</a>
								</li>
							@endauth
						</ul>
					</div>
				</div>
			</div>
			<div class="main_menu">
				<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="{{ route('start.page') }}">
							<img src="{{ asset('img/logo.png') }}" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<div class="row w-100">
								<div class="col-lg-6 pr-0">
									<ul class="nav navbar-nav center_nav pull-right">
										<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
											<a class="nav-link" href="{{ route('start.page') }}">Página inicial</a>
										</li>
										<li class="nav-item {{ Request::is('shop*') ? 'active' : '' }}">
											<a class="nav-link" href="{{ route('shop.page') }}">Shop</a>
										</li>
										
										<li class="nav-item {{ Request::is('blog*') ? 'active' : '' }}">
											<a class="nav-link" target="_blank" href="http://localhost/preciosagarridoblog">Blog</a>
										</li>
										<li class="nav-item {{ Request::is('contacts*') ? 'active' : '' }}">
											<a class="nav-link" href="{{ route('contacts') }}">Contactos</a>
										</li>
									</ul>
								</div>

								<div class="col-lg-6">
									<ul class="nav navbar-nav navbar-right right_nav pull-right">
										<hr>
										<div>
											<search-component></search-component>
										</div>

										<hr>

										<li class="nav-item">
											@auth
												<a href="{{ route('myaccount') }}" class="tooltips icons item-menu">
													<span class="tooltips-text">Minha conta</span>
													<i class="fa fa-user" aria-hidden="true"></i>
												</a>
											@endauth
										</li>

										<hr>
										@auth
											<li class="nav-item">
												<a href="{{ route('wishlist.page') }}" class="tooltips icons item-menu">
													<span class="tooltips-text">Lista de desejos</span>
													<i class="fa fa-heart-o" aria-hidden="true"></i>
												</a>
											</li>
											<hr>

											<li class="nav-item">
												<a href="{{ route('chat') }}" class="tooltips icons item-menu">
													<span class="tooltips-text">Bate papo</span>
													<i class="fa fa-comment-o"></i>
												</a>
											</li>
											<hr>
										@endauth

										<li class="nav-item">
											<a href="{{ route('cart.page') }}" class="tooltips icons item-menu">
												<span class="tooltips-text">Carrinho</span>
												<i class="lnr lnr-cart"></i>
											</a>
										</li>
										<hr>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</nav>
			</div>
		</header>
		<!--================Header Menu Area =================-->

		<!--================Home Banner Area =================-->
		<div>
	    	@yield('content')
		</div>
	</div>
	<!--================ start footer Area  =================-->
	<footer class="footer-area pt-5 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">Newsletter</h6>
						<p>Mantem-te actualizado das novidades</p>
						<p>Assine nossa newsletter</p>
						<div id="mc_embed_signup">
							<form class="subscribe_form relative" id="newsletterForm" novalidate="novalidate">
								{{ csrf_field() }}
								<div class="input-group d-flex flex-row">
									@auth
										<input type="email" name="email" value="{{ auth()->user()->email }}" />
									@else
										<input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" />
									@endauth
									<button class="btn sub-btn">
										<span class="lnr lnr-arrow-right"></span>
									</button>
								</div>
								<div class="mt-10 info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="single-footer-widget f_social_wd">
						<h6 class="footer_title">Siga-nos</h6>
						<p>Nas redes sociais</p>
						<div class="f_social">
							<a href="http://www.facebook.com/preciosagarrido">
								<i class="fa fa-facebook"></i>
							</a>
							<a href="http://www.twitter.com/page=#preciosagarrido">
								<i class="fa fa-twitter"></i>
							</a>
							<a href="http://www.dribbble.com/preciosagarrido">
								<i class="fa fa-dribbble"></i>
							</a>
							<a href="http://www.whatsapp.com/preciosagarrido">
								<i class="fa fa-whatsapp"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-12 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
&copy; Copyright <?php print date('Y') ?> Todos os direitos reservados | Desenvolvido por <i class="fa fa-heart-o" aria-hidden="true"></i> Dorivaldo Valentim de <a href="https://ces.co.ao" target="_blank">CES</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/popper.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/stellar.js') }}"></script>
	<script src="{{ asset('js/simpleLightbox.min.js') }}"></script>
	<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('js/isotope-min.js') }}"></script>
	<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('js/jquery.counterup.js') }}"></script>
	<script src="{{ asset('js/theme.js') }}"></script>

	<script src="{{ asset('js/script.js') }}"></script>
	<script src="{{ asset('js/sweetalert.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>

	<script src="{{ asset('js/tooltip.js') }}"></script>
	@yield('js')
</body>

</html>