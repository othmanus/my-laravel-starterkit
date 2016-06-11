@if(Session::has('message'))
<div class="alert alert-info alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-info"></i> Information</h4>
	{{ session('message') }}
</div>
@endif