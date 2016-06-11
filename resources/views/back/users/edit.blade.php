@extends('back.layouts.index')

{{-- Titre de la page --}}
@section('content-header')
<h1>
	Gestion des utilisateurs
	<small>{{ $user->email }}</small>
</h1>
{{-- {!! Breadcrumbs::render('admin.users.edit', $user) !!} --}}
@stop

{{-- Contenu de la page --}}
@section('content')
<div class="row">
	<div class="col-xs-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Modifier l'utilisateur</h3>
			</div><!-- /.box-header -->
			{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'role' => 'form']) !!}
			<div class="box-body">
				@include('back.layouts._alert')
				<p class="text-muted">Les champs marqués par <span class="text-red">*</span> sont obligatoires</p>
				<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
					<label for="name" class="control-label">Nom <span class="text-red">*</span></label>
					<input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}" placeholder="Entrer le nom de l'utilisateur" required>
					<p class="text-red">{{ $errors->first('name') }}</p>
				</div>
				<div class="form-group {{ $errors->first('role') ? 'has-error' : '' }}">
					<label for="role" class="control-label">Role <span class="text-red">*</span></label>
					<select name="role" id="role" class="form-control">
						<option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur</option>
						<option value="administrator" {{ $user->role == 'administrator' ? 'selected' : '' }}>Administrateur (tous les privilèges)</option>
						<option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Modérateur</option>
					</select>
					<p class="text-red">{{ $errors->first('role') }}</p>
				</div>
				<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
					<label for="email" class="control-label">Email <span class="text-red">*</span></label>
					<input type="email" class="form-control" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}" placeholder="Entrer l'email de l'utilisateur " required>
					<p class="text-red">{{ $errors->first('email') }}</p>
				</div>
				<div class="form-group">
					<label for="active" class="control-label">Statut</label>
					<select class="form-control" name="active" id="active">
						<option value="0" {{ !$user->active ? 'selected' : '' }}>Bloqué</option>
						<option value="1" {{ $user->active ? 'selected' : '' }}>Activé</option>
					</select>
				</div>

			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" id="save" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box -->
	</div><!-- /.col-xs-6 -->
	<div class="col-xs-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Changer mot de passe</h3>
			</div><!-- /.box-header -->
			{!! Form::open(['route' => ['admin.users.changePassword', $user->id], 'method' => 'PUT', 'role' => 'form']) !!}
			<div class="box-body">
				<div class="form-group {{ $errors->first('old_password') ? 'has-error' : '' }}">
					<label for="old_password" class="control-label">Ancien mot de passe</label>
					<input type="password" class="form-control" id="old_password" placeholder="Entrer le nouveau mot de passe de l'utilisateur" disabled>
					<p class="text-red">{{ $errors->first('old_password') }}</p>
				</div>
				<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
					<label for="password" class="control-label">Nouveau mot de passe</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Entrer le nouveau mot de passe de l'utilisateur">
					<p class="text-red">{{ $errors->first('password') }}</p>
				</div>
				<div class="form-group {{ $errors->first('password_confirmation') ? 'has-error' : '' }}">
					<label for="password_confirmation" class="control-label">Confirmer le nouveau mot de passe</label>
					<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re taper le nouveau mot de passe de l'utilisateur">
					<p class="text-red">{{ $errors->first('password_confirmation') }}</p>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" id="save_password" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box -->
	</div><!-- /.col-xs-6 -->
	
</div><!-- /.row -->
@stop