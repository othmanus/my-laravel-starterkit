@extends('back.layouts.index')

@section('meta_title')
Gestion des pages
@stop

@section('content-header')
<h1>
	Gestion des pages
</h1>
{{-- {!! Breadcrumbs::render('admin.page.index') !!} --}}
@stop

@section('content')
<div class="row">
	<div class="col-md-10 col-sm-12 col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Toutes les pages</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				@include('back.layouts._alert')
				<p>
					<a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
				</p>
				<table class="table table-hover">
					
					<tr>
						<th style="width: 10px">#</th>
						<th>Image</th>
						<th>Titre</th>
						<th>Catégorie</th>
						<th style="width: 30%"></th>
					</tr>
					@if($pages->isEmpty())
					<tr>
						<td colspan="5">
							<div class="alert alert-warning">
								<p>Il n'y a aucun élément à afficher.</p>
							</div>
						</td>
					</tr>
					@endif
					@foreach($pages as $page)
					<tr>
						<td>{{ $page->id }}</td>
						<td><img src="{{ $page->present()->default_image_thumbnail }}" alt="{{ $page->title }}"></td>
						<td>{{ $page->title }}</td>
						<td>{{ $page->category }}</td>
						<td>
							{!! Form::open(['route' => ['admin.pages.destroy', $page->id], 'method' => 'delete', 'class' => 'pull-right']) !!}
								<a href="{{ route('admin.pages.edit', $page->id) }}" role="button" class="btn btn-success btn-xs" title="Modifier"><i class="fa fa-pencil-square-o"></i></a>	
								<button type="submit" class="btn btn-danger btn-delete btn-xs" title="Supprimer" data-toggle="#modal-delete"  data-target="#modal-delete"><i class="fa fa-times"></i></button>
							{!! Form::close() !!}						
							</div>
						</td>
					</tr>
					@endforeach
					
				</table>
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				
				{!! $pages->render() !!}
				
			</div>
		</div><!-- /.box -->
	</div><!-- /.col -->

</div><!-- /.row -->
@stop
