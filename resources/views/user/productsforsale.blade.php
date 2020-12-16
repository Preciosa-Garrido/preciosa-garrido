@extends('layouts.structure')

@section('title', 'Ver produtos de venda')

@section('content')

	<div class="section_gap">
		<div class="container">
			<h2 class="text-center">Ver produtos da venda</h2>
			@foreach($products as $product)
				<div class="alert alert-info col-md-3">
					<p>{{ $product->product->product }}</p>
					<p>{{ $product->qtd }}</p>
					<p>{{ $product->price }}</p>
					<p>{{ $product->product->category->category }}</p>
				</div>
			@endforeach
		</div>
	</div>

@endsection