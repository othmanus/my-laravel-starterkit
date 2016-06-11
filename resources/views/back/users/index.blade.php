@extends('back.layouts.index')

{{-- css --}}
@section('head')

@stop

{{-- Titre de la page --}}
@section('content-header')
<h1>
	Gestion des utilisateurs
</h1>
{{-- {!! Breadcrumbs::render('admin.users.index') !!} --}}
@stop

{{-- Contenu de la page --}}
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tous les utilisateurs</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				@include('back.layouts._alert')
				<p>
					<a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
				</p>
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width: 10px">#</th>
							<th>Nom </th>
							<th>Email</th>
							<th>Role</th>
							<th>Activé</th>
							<th style="width: 90px"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->role }}</td>
							<td>{!! $user->confirmed ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-ban text-red"></i>'!!}</td>
							<td>
								{!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete', 'class' => 'pull-right']) !!}
								<a href="{{ route('admin.users.edit', $user->id) }}" role="button" class="btn btn-success btn-xs" title="Modifier"><i class="fa fa-pencil-square-o"></i></a>
								@if(Auth::user()->id != $user->id)
								<button type="submit" class="btn btn-danger btn-delete btn-xs" title="Supprimer" data-toggle="#modal-delete"  data-target="#modal-delete"><i class="fa fa-times"></i></button>
								@endif
								{!! Form::close() !!}
							</td>
						</tr>
						@endforeach
					</tbody>
					
				</table>
			</div><!-- /.box-body -->
			{{-- <div class="box-footer clearfix">
				{!! $users->render() !!}
			</div> --}}
		</div><!-- /.box -->
	</div><!-- /.col -->

</div><!-- /.row -->
@stop

{{-- javascript --}}
@section('javascript')
<script>
	$(".table").DataTable();
</script>
@stop