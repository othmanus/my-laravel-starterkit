@extends('back.layouts.index')

@section('meta_title')
Créer une page
@stop

@section('content-header')
<h1>
	Gestion des pages
</h1>
@stop

@section('content')
<div class="row">
	<div class="col-md-6 col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Créer la page</h3>
			</div><!-- /.box-header -->
			{!! Form::open(['route' => ['admin.pages.store'], 'method' => 'post', 'role' => 'form']) !!}
			<div class="box-body">
				@include('back.layouts._alert')
				<p class="text-muted">Les champs marqués par <span class="text-red">*</span> sont obligatoires</p>
				
				<div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
					<label for="title" class="control-label">Titre <span class="text-red">*</span></label>
					<input type="text" class="form-control" name="title" id="title" value="{{ old('title')}}" placeholder="Entrer le titre de la page" required>
					<p class="text-red">{{ $errors->first('title') }}</p>
				</div>
				<div class="form-group {{ $errors->first('category') ? 'has-error' : '' }}">
					<label for="category" class="control-label">Catégorie <span class="text-red">*</span></label>
					<select class="form-control" name="category" id="category">
						<option value="about" {{ old('category') == "about" ? "selected" : ""}}>Présentation</option>
						<option value="services" {{ old('category') == "services" ? "selected" : ""}}>Services</option>
						<option value="terms" {{ old('category') == "terms" ? "selected" : ""}}>Conditions d'utilisation</option>
					</select>
					<p class="text-red">{{ $errors->first('category') }}</p>
				</div>
				<div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
					<label for="content" class="control-label">Contenu <span class="text-red">*</span></label>
					<textarea class="form-control" name="content" id="content" required>
						{{ old('content')}}
					</textarea>
					<p class="text-red">{{ $errors->first('content') }}</p>
				</div>

				<div id="images_id"></div>
			</div><!-- /.box-body -->
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
				@include('back.images._dropzone', ['model' => new App\Models\Page\Page])
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