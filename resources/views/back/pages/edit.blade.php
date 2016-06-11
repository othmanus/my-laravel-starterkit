@extends('back.layouts.index')

@section('meta_title')
Modifier une ---
@stop

@section('content-header')
<h1>
	Gestion des pages
	<small>{{ $module->title }}</small>
</h1>
@stop

@section('content')
<div class="row">
	<div class="col-md-6 col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Modifier la page</h3>
			</div><!-- /.box-header -->
			{!! Form::model($module, ['route' => ['admin.pages.update', $module->id], 'method' => 'put', 'role' => 'form']) !!}
			<div class="box-body">
				@include('back.layouts._alert')
				<p class="text-muted">Les champs marqués par <span class="text-red">*</span> sont obligatoires</p>
				
				<div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
					<label for="title" class="control-label">Titre <span class="text-red">*</span></label>
					<input type="text" class="form-control" name="title" id="title" value="{{ old('title') ? old('title') : $page->title}}" placeholder="Entrer le titre de la page" required>
					<p class="text-red">{{ $errors->first('title') }}</p>
				</div>
				<div class="form-group {{ $errors->first('category') ? 'has-error' : '' }}">
					<label for="category" class="control-label">Catégorie <span class="text-red">*</span></label>
					<select class="form-control" name="category" id="category">
						<option value="about" {{ $page->category == "about" ? "selected" : ""}}>Présentation</option>
						<option value="services" {{ $page->category == "services" ? "selected" : ""}}>Services</option>
						<option value="terms" {{ $page->category == "terms" ? "selected" : ""}}>Conditions d'utilisation</option>
					</select>
					<p class="text-red">{{ $errors->first('category') }}</p>
				</div>
				<div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
					<label for="content" class="control-label">Contenu <span class="text-red">*</span></label>
					<<textarea class="form-control" name="content" id="content" required>
						{{ old('content') ? old('content') : $page->content }}
					</textarea>
					<p class="text-red">{{ $errors->first('content') }}</p>
				</div>
				
			</div><!-- /.box-body -->
			<div id="images_id"></div>
			<div class="box-footer">
				<button type="submit" id="save" class="btn btn-primary"><i class="fa fa-save"></i> Enregister</button>
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box -->
	</div><!-- /.col-xs-6 -->
	 
	<div class="col-md-6 col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Gallerie d'images</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				@include('back.images._dropzone', ['model' => $page])
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col-xs-6 -->
	
</div><!-- /.row -->
@stop

@section('javascript')
<script type="text/javascript">
	CKEDITOR.replace('content');
</script>
@stop