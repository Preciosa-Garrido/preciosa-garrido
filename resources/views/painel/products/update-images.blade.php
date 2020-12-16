@extends('layouts.painel')

@section('title', 'Ver imagens do produto')

@section('breadcrumb')
	
	<li>
		<a href="{{ route('products.consultar') }}">
			<span>Produto</span>
		</a>
	</li>

	<li>
		<span>Imagens</span>
	</li>

	<li>
		<span>Actualizar</span>
	</li>

@stop

@section('css')
	<style>
		.thumbnail.no-margin-bottom .img-responsive {
			width: 100%;
			height: 20em;
		}
	</style>
@stop

@section('content')

	<div class="container-fluid">		
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="thumbnail no-margin-bottom">
                    <img src="{{ asset('storage/product/'.$images->image1) }}" class="img-responsive">
                    <div class="caption">
                        <h3 id="thumbnail-label">Alternativa 1<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="thumbnail no-margin-bottom">
                    <img src="{{ asset('storage/product/'.$images->image2) }}" class="img-responsive">
                    <div class="caption">
                        <h3 id="thumbnail-label">Alternativa 2<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
				<a href="{{ url('painel/products/show/'.$product->id) }}" class="btn btn-info btn-sm">Voltar</a>
            </div>
        </div>
	</div>

@stop