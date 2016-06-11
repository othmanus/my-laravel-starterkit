<meta charset="UTF-8">
<title>Administration | {{ $settings['site_name']->to_string }}</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- dropzone bootstrap -->
<link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone-bootstrap.css') }}">
<!-- Theme style -->
<link href="{{ asset('back/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('back/css/_all-skins.css') }}" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<!-- jquery.js -->
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- bootstrap.js -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- Protection CSRF en ajax -->
<meta name="_token" content="{{ csrf_token() }}">
<script type="text/javascript">
	$.ajaxSetup({
		data: {
			_token: $('meta[name="_token"]').attr('content')
		}
	});
</script>