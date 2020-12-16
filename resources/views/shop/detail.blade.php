@extends('layouts.structure')

@section('title', 'Detalhes')

@section('content')

	<!-- ================ Single Product Area ================= -->
	<div class="product_image_area section_gap">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" width="100px">
									<img src="{{ asset('storage/product/'.$product->image) }}" alt="">
								</li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1">
									<img src="{{ asset('storage/product/'.$image->image1) }}" alt="">
								</li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2">
									<img src="{{ asset('storage/product/'.$image->image2) }}" alt="">
								</li>
							</ol>

							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="{{ asset('storage/product/'.$product->image) }}" class="img-fluid d-block w-100" />
								</div>
								<div class="carousel-item">
									<img src="{{ asset('storage/product/'.$image->image1) }}" class="img-fluid d-block w-100" />
								</div>
								<div class="carousel-item">
									<img src="{{ asset('storage/product/'.$image->image2) }}" class="img-fluid d-block w-100" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $product->product }}</h3>
						<h2>{{ number_format($product->price, 2, ',', ' ') }} KZs</h2>
						<ul class="list">
							<li>
								<a class="active" href="#" style="cursor: text;">
									<span>Categoria</span> : {{ $product->category->category }}
								</a>
							</li>
							<li>
								<a href="#" style="cursor: text;">
									<span>No estoque</span> : {{ $product->stock }}
								</a>
							</li>
						</ul>
						<p>{{ $product->description }}</p>

						<div>
							<div class="product_count">
								<label for="quantidade">Quantidade:</label>
								<input type="number" name="quantidade" id="quantidade" max="{{ $product->stock }}" min="1" value="1" class="input-text qty" style="padding: 5px 15px" />
							</div>
							<input type="hidden" name="product_id" value="{{ $product->id }}" />
							<div class="card_area">	
								<button onclick="storeCart({{$product}})" class="main_btn" style="float: left;">Adicionar ao carrinho</button>
							</div>
						</div>
						<div class="card_area">
				        	@auth
				        		<form class="addWishlist">
			  	  					{{ csrf_field() }}
									<input type="hidden" name="product_id" value="{{ $product->id }}" />
									<input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
									<button type="submit" class="icon_btn" style="border: 0">
										<span class="lnr lnr-heart"></span>
									</button>
			  	  				</form>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Especificações</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comentários</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Avaliação</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<specification-component :product="{{ $product }}"></specification-component>
				@auth
					<comments-component :produto="{{ $product->id }}" :auth="{{ auth()->user()->id }}"></comments-component>
					<reviews-component :produto="{{ $product->id }}" :auth="{{ auth()->user()->id }}"></reviews-component>
				@else
					<comments-component :produto="{{ $product->id }}" :auth="null"></comments-component>
					<reviews-component :produto="{{ $product->id }}" :auth="null"></reviews-component>
				@endauth
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

@stop