@extends('back.layouts.index')

@section('meta_title')
Configuration
@stop

{{-- css --}}
@section('head')

@stop

{{-- Titre de la page --}}
@section('content-header')
<h1>
	Configurations
</h1>
{{-- {!! Breadcrumbs::render('admin.settings.index') !!} --}}
@stop

{{-- Contenu de la page --}}
@section('content')
<div class="row">
	<div class="col-md-8 col-xs-12">
		@include('back.layouts._alert')
		<!-- Informations générales -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-info-circle"></i>  Informations générales</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-globe"></i></td>
							<td>Nom du site</td>
							<td>{!! $site_name->to_string !!}</td>
							<th><a href="{{ route('admin.settings.edit', $site_name->id) }}"  role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></th>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-code"></i></td>
							<td>Slogan</td>
							<td>{!! $slogan->to_string !!}</td>
							<th><a href="{{ route('admin.settings.edit', $slogan->id) }}"  role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></th>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-picture-o"></i></td>
							<td>Logo</td>
							<td><img src="{{ asset($logo->to_string) }}" width="150px" class="img-responsive"></td>
							<th><a href="{{ route('admin.settings.edit', $logo->id) }}"  role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></th>
						</tr>						
						<tr>
							<td class="text-center"><i class="fa fa-key"></i></td>
							<td>Mots clés</td>
							<td>{!! $keywords->to_string !!}</td>
							<th><a href="{{ route('admin.settings.edit', $keywords->id) }}"  role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></th>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- Coordonnées de contact -->
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-envelope"></i> Coordonnées de contact principaux</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-home"></i></td>
							<td>Adresse</td>
							<td>{!! $address->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $address->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-phone"></i></td>
							<td>N° Téléphone</td>
							<td>{!! $phone->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $phone->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-mobile"></i></td>
							<td>N° Mobile</td>
							<td>{!! $mobile->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $mobile->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-fax"></i></td>
							<td>N° Fax</td>
							<td>{!! $fax->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $fax->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-at"></i></td>
							<td>Email</td>
							<td>{!! $email->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $email->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-clock-o"></i></td>
							<td>Horaires d'ouverture</td>
							<td>{!! $opening_time->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $opening_time->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<!-- Coordonnées de contact -->
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-envelope"></i> Nos adresses</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-home"></i></td>
							<td>Nos adresses</td>
							<td>{!! $full_address->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $full_address->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- Réseaux sociaux -->
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-share-alt"></i> Réseaux sociaux</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-facebook"></i></td>
							<td>Facebook</td>
							<td>{!! $facebook->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $facebook->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-google-plus"></i></td>
							<td>Google+</td>
							<td>{!! $google->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $google->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-twitter"></i></td>
							<td>Twitter</td>
							<td>{!! $twitter->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $twitter->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-youtube"></i></td>
							<td>Youtube</td>
							<td>{!! $youtube->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $youtube->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-linkedin"></i></td>
							<td>LinkedIn</td>
							<td>{!! $linkedin->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $linkedin->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-instagram"></i></td>
							<td>Instagram</td>
							<td>{!! $instagram->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $instagram->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-graduation-cap"></i> Expérience</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-building-o"></i></td>
							<td>Sites en Algérie</td>
							<td>{!! $nbr_sites->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $nbr_sites->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-users"></i></td>
							<td>Employés</td>
							<td>{!! $nbr_employes->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $nbr_employes->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-globe"></i></td>
							<td>Villes couvertes</td>
							<td>{!! $nbr_villes->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $nbr_villes->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-graduation-cap"></i></td>
							<td>Années d'expérience</td>
							<td>{!! $nbr_experience->to_string !!}</td>
							<td><a href="{{ route('admin.settings.edit', $nbr_experience->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- Google Map -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-map-marker"></i> Coordonnées de la carte (Google Map)</h3>
			</div><!-- /.box-header -->
			<div class="box-body">

				<p class="text-muted">
					Aller à <a href="http://www.coordonnees-gps.fr/" target="_blank">ce site</a> et chercher votre adresse. Une fois détermintée, copier les coordonnées "latitude" et "longitude" de votre location ici. <br>
					<b>Latitude</b> : est l'axe Nord-Sud <br>
					<b>Longitude</b> : est l'axe Est-Ouest.
				</p>
				<table class="table table-stripped">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="15%">Configuration</th>
							<th>Valeur</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><i class="fa fa-arrows-h"></i></td>
							<td>Latitude</td>
							<td>{{ $latitude->to_string }}</td>
							<td><a href="{{ route('admin.settings.edit', $latitude->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
						<tr>
							<td class="text-center"><i class="fa fa-arrows-v"></i></td>
							<td>Longitude</td>
							<td>{{ $longitude->to_string }}</td>
							<td><a href="{{ route('admin.settings.edit', $longitude->id) }}" role="button" class="btn btn-success btn-xs btn-edit" title="Modifier"><i class="fa fa-pencil-square-o"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->

<!-- Modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit-title" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal-edit-title">Modifier la configuration</h4>
			</div>
			<div class="modal-body" id="modal-edit-body">
				
			</div>
		</div>
	</div>
</div>
@stop

{{-- javascript --}}
@section('javascript')
<script type="text/javascript">
	$('.btn-edit').on('click', function(e){ 
		e.preventDefault();

		var url = $(this).attr('href');

		$.ajax({
			type: "GET",
			url: url,
			dataType: "html",
			success: function(html)
			{
				$("#modal-edit-body").html(html);
				$("#modal-edit").modal("show");
			}
		})
		return false;
	});
</script>

<script type="text/javascript">
	$('#modal-edit').on('show.bs.modal', function (event) {
		// CKEDITOR.replace('value');
		$( 'textarea#value' ).ckeditor();
	});
</script>

@stop 
