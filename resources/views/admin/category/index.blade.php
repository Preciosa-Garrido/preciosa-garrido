@extends('layouts.admin')

@section('title', 'Listar categorias')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.category.consultar') }}">
			<span>Categorias</span>
		</a>
	</li>
	
	<li>
		<span>Consultar</span>
	</li>
@stop

@section('content')
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar categorias</h4>
				</div>
			</div>
			<div class="card-body">
				@if(session('mensagem'))
					<div class="alert alert-warning">
						<p>{{ session('mensagem') }}</p>
					</div>
				@endif
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Categoria</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Categoria</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->category }}</td>
                                    <td>
                                        <a href="{{ url('admin/categories/destroy/'.$category->id) }}">Apagar</a>
                                        | <a href="{{ url('admin/categories/edit/'.$category->id) }}">Actualizar</a> | <a href="{{ url('admin/categories/show/'.$category->id) }}">Ver categoria</a>
                                    </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

@stop
