@extends('layouts.admin')

@section('title', 'Consultar Notificações')

@section('breadcrumb')

	<li>
		<a href="{{ route('admin.notifications') }}">
			<span>Notificações</span>
		</a>
	</li>

	<li>
		<span>Consultar</span>
	</li>

@endsection

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Consultar notificações</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							{{ session('mensagem') }}
						</div>
					@endif
					<div class="table-responsive col-md-12">
						<table class="datatable table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Estado</th>
									<th>Tipo</th>
									<th>Descrição</th>
									<th>Data</th>
									<th>Operações</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Estado</th>
									<th>Tipo</th>
									<th>Descrição</th>
									<th>Data</th>
									<th>Operações</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach($notifications as $notification)
									<tr>
										<td>{{ $notification->id }}</td>
										<td>
											@if($notification->status == 0)
												Não vista
											@else
												Vista
											@endif
										</td>
										<td>
											@if($notification->type == 'sale')
												Venda
											@endif
										</td>
										<td>{{ $notification->content }}</td>
										<td>{{ $notification->created_at }}</td>
										<td>
											<a href="{{ url('admin/notifications/destroy/'.$notification->id) }}">Eliminar</a>

											@if($notification->status == 0)
											 ||
												<a href="{{ url('admin/notifications/update/'.$notification->id) }}" class="btn btn-primary btn-sm">Marcar como vista</a>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection