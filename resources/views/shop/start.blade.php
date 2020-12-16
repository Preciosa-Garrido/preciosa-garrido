@extends('layouts.structure')

<?php use App\Models\Product; ?>

@section('title', 'Pagina inicial')

@section('content')

			<div class="welcome" style="background: linear-gradient(rgba(0, 0, 0, 0.75) 100%, rgba(0, 0, 0, 0.75) 100%), url({{ asset('img/banner/banner.jpg') }}) no-repeat scroll center center; background-size: cover">
				<div class="container">
					<h1>Bem vindo</h1>
					<p>Para continuar clique no botão a seguir</p>
					<a href="#" id="btn-bottom" class="main_btn">
						<i class="lnr lnr-arrow-down"></i>
					</a>
				</div>
			</div>

			<!-- Start Most Search Product Area -->
			<section class="section-half" id="home">
				<div class="container">
					<div class="organic-section-title text-center">
						<h2 style="padding-bottom: 40px">Recentes</h2>
					</div>
					<div class="row mt-30">
						@forelse($recents as $item)
							<div class="col-lg-3 col-md-4 col-sm-6">
								<div class="single-search-product d-flex">
									<a href="{{ url('shop/product/'.$item->id) }}"><img src="{{ asset('storage/product/'.$item->image) }}" alt=""></a>
									<div class="desc">
										<a href="{{ url('shop/product/'.$item->id) }}" class="title">{{ $item->product }}</a>
										<div class="price"><span class="lnr lnr-tag"></span> {{ number_format($item->price, 2, ',', ' ') }} KZs</div>
									</div>
								</div>
							</div>
						@empty
							<p class="text-center">Não há recentes</p>
						@endforelse
					</div>
				</div>
			</section>
			<!-- End Most Search Product Area -->

	        <!--================Testimonials Area =================-->
	        <section class="testimonials_area p_120" style="background: linear-gradient(rgba(0, 0, 0, 0.75) 100%, rgba(0, 0, 0, 0.75) 100%), url({{ asset('img/testimonials_background.jpg') }}) no-repeat scroll center center;">
	        	<div class="container">
	        		<div class="row testimonials_inner">
	        			<div class="col-lg-4">
	        				<div class="testi_left_text">
	        					<h4>O que nossos clientes dizem</h4>

	        					<p>Confira ao lado o que os nossos clientes dizem sobre o nosso site</p>

	        					<?php if($contacts->count() == 0) { ?>
	        						<p>Ainda não há mensagens para serem apresentadas</p>
	        					<?php } ?>
	        				</div>
	        			</div>
	        			<div class="col-lg-8">
	        				<div class="testi_slider owl-carousel">
	        					@foreach($contacts as $contact)
									<div class="item">
										<div class="testi_item">
											@if($contact->user_id)
												<img src="{{ asset('storage/users/'.$contact->user->foto) }}" alt="Imagem do usuário" />
												<p>{{ $contact->message }}</p>
												<h4>{{ $contact->user->first_name }} {{ $contact->user->last_name }}</h4>
												<h6>Assunto: {{ $contact->subject }}</h6>
											@else
												<img src="{{ asset('storage/users/user_man.jpg') }}" alt="Imagem do usuário" />
												<p>{{ $contact->message }}</p>
												<h4>{{ $contact->name }}</h4>
												<h6>Assunto: {{ $contact->subject }}</h6>
											@endif
										</div>
									</div>
								@endforeach
							</div>
	        			</div>
	        		</div>
	        	</div>
	        </section>
	        <!--================End Testimonials Area =================-->
	
			<!-- Start brand Area -->
			<section class="brand-area pb-100">
				<div class="organic-section-title text-center">
					<h2 style="padding-top: 60px">Parceiros</h2>
				</div>
				<div class="container">
					<div class="row logo-wrap">
						@foreach($parceiros as $parceiro)
							<a class="col single-img" href="{{ url($parceiro->site) }}" target="_blank">
								<img class="d-block mx-auto" src="{{ asset('storage/parceiros/'.$parceiro->logo) }}" alt="">
							</a>
						@endforeach
					</div>	
				</div>	
			</section>
			<!-- End brand Area -->

@stop