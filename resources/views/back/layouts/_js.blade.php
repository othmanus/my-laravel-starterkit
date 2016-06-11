<!-- jquery-ui.js -->
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('vendor/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- ckeditor -->
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/ckeditor/adapters/jquery.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ asset('back/js/AdminLTE/app.js') }}" type="text/javascript"></script>

<!-- datatables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>

<!-- Initialiser icheck -->
<script type="text/javascript">
	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].icheck, input[type="radio"].icheck').iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal'
	});
</script>