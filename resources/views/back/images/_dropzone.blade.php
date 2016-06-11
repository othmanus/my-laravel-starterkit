<?php 
// if the Model is "Page", module name would be "page"
$module = Str::snake(class_basename($model)); 
?>
<p class="text-muted">Glissez vos fichiers ici ou cliquez sur <i class="fa fa-plus"></i> pour ajouter des images. </p>
<p class="text-muted">
  Dimensions: {{ head($model->image_styles)['width'] .' x '. head($model->image_styles)['height'] }} px - Max à ajouter : {{ $model->remaining_images }}
</p>
<div id="actions" class="row">
	<div class="col-lg-7">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button" title="Ajouter">
			<i class="fa fa-picture-o"></i> Ajouter des images
		</span>
	</div>

	<div class="col-lg-5">
		<!-- The global file processing state -->
		<span class="fileupload-process">
			<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
			</div>
		</span>
	</div>

</div>
<div class="table table-striped ui-sortable" class="files" id="previews">
	@foreach($model->images as $image)
	@if($image)
	<div id="sortable-{{ $image->id }}" class="file-row dz-image-preview dz-processing dz-success" data-id="{{ $image->id }}" data-style="{{ $module }}">
		<!-- This is used as the file preview template -->
		<div>
			<span class="handle">
				<i class="fa fa-arrows"></i>
			</span>
		</div>
		<div>
      <span class="preview"><img data-dz-thumbnail="" alt="{{ $image->file_name }}" src="{{ $image->present()->thumbnail }}"></span>
		</div>
		<div>
			<p class="name" data-dz-name="">{{ $image->url }}</p>
			<strong class="error text-danger" data-dz-errormessage=""></strong>
		</div>
		<div>
			<p class="size" data-dz-size=""></p>
			<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				<div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
			</div>
		</div>
		<div class="btn-group pull-right">
			<button class="btn btn-success edit" onclick="edit_image(event, '{{ url('json/images/dropzone/get') . "/{$image->id}" }}')" data-id="{{ $image->id }}" title="Modifier">
				<i class="fa fa-pencil"></i>
			</button>
			<button data-dz-remove class="btn btn-danger remove-file" data-id="{{ $image->id }}" title="Supprimer">
				<i class="fa fa-trash-o"></i>
			</button>
		</div>
	</div>
	@endif
	@endforeach
	<div id="template" class="file-row">
		<!-- This is used as the file preview template -->
		<div>
			<span class="handle">
				<i class="fa fa-arrows"></i>
			</span>
		</div>
		<div>
			<span class="preview"><img data-dz-thumbnail /></span>
		</div>
		<div>
			<p class="name" data-dz-name></p>
			<strong class="error text-danger" data-dz-errormessage></strong>
		</div>
		<div>
			<p class="size" data-dz-size></p>
			<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
			</div>
		</div>
		<div class="btn-group pull-right">
			<button class="btn btn-success edit" title="Modifier">
				<i class="fa fa-pencil"></i>
			</button>
			<button data-dz-remove class="btn btn-danger delete" title="Supprimer">
				<i class="fa fa-trash-o"></i>
			</button>
		</div>
	</div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit-title" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="modal-edit-body">
				<div class="overlay" id="overlay"></div>
				<div class="loading-img" id="loading-img"></div>
				<div class="form-group">
					<label for="title" class="control-label">Titre</label>
					<input type="text" id="img-title" class="form-control">
				</div>
				<div class="form-group">
					<label for="description" class="control-label">Description</label>
					<textarea id="img-description" cols="30" rows="10" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="default" class="control-label">Image par défaut</label>
					<select id="img-default" class="form-control">
						<option value="0"><i class="fa fa-circle-o text-red"></i> Non</option>
						<option value="1"><i class="fa fa-circle text-green"></i> Oui</option>
					</select>
				</div>
				<div class="form-group">
					<label for="link" class="control-label">URL</label>
					<input type="text" id="img-link" class="form-control" placeholder="http://">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-edit-confirm" onclick="update_image(event, '')"><i class="fa fa-pencil"></i> Enregistrer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			</div>
		</div>
	</div>
</div>
<!-- Modification -->
<script type="text/javascript">
  	// Ouvrir le formulaire d'édition
  	function edit_image(event, url) { 
  		event.preventDefault();
  		$("#modal-edit").modal("show");
  		$("#overlay").show();
  		$("#loading-img").show();

  		$.ajax({
  			type: "GET", 
  			dataType: "json",
  			url: url,
  			success: function(image) {
  				$("#img-title").val(image.title);
  				$("#img-description").val(image.description);
  				$("#img-default").val(image.default);
  				$("#img-link").val(image.link);
  				$("#btn-edit-confirm").attr('onclick', 'update_image(event, "{{ url("json/images/dropzone/update") }}/'+image.id+'")');

  				$("#overlay").hide();
  				$("#loading-img").hide();
  			}
  		});
  	}

  	// Update image en ajax
  	function update_image(event, url) { 
  		event.preventDefault();
  		$("#modal-edit").modal("show");
  		$("#overlay").show();
  		$("#loading-img").show();

  		var data = {
  			title: $("#img-title").val(),
  			description: $("#img-description").val(),
  			link: $("#img-link").val(),
  			default: $("#img-default").val()
  		}; 

  		$.ajax({
  			type: "POST", 
  			dataType: "json", 
  			url: url,
  			data: data,
  			success: function(json)
  			{
  				$("#modal-edit").modal('hide');
  				$("#overlay").hide();
  				$("#loading-img").hide();
  			}
  		});
  	}
  
</script>

<!-- dropzone -->
<script src="{{ asset('vendor/dropzone/build/build.js?v=6') }}"></script>
<script>
	var Dropzone = require("enyo-dropzone");
	Dropzone.autoDiscover = false;
</script>
<script>
    // Get the template HTML and remove it from the doument
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    
    var max_images = {{ $model->max_images }};
    @if($model->remaining_images >= 0) 
    max_images = {{ $model->remaining_images }};
    @endif
    // Make the whole body a dropzone
    var myDropzone = new Dropzone(document.body, { 
    	// Set the url for upload
      url: "{{ route('admin.images.dropzone.upload') }}", 
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 5,
      previewTemplate: previewTemplate,
   		maxFilesize: 3,
   		maxFiles: max_images,
   		acceptedFiles: 'image/*',
      // Define the container to display the previews
      previewsContainer: "#previews", 
      // Define the element that should be used as click trigger to select files.
      clickable: ".fileinput-button", 
    });

    
    // Handle the response when uploaded. 
    myDropzone.on("success", function (file, response) {
    	var id = response.image.id;
      	// Add "data-id" attribute. Its the Image id (in database)
      	file.previewElement.setAttribute('data-id', id);
      	// Add an ID to element (for jquery-ui sortable)
      	file.previewElement.setAttribute('id', 'sortable-'+id);
      	// Find edit button
    	file.previewElement.children[4].children[0].setAttribute('onclick', 'edit_image(event, "{{ url("json/images/dropzone/get") }}/'+id+'")');
      	// create hidden input in the form
      	$("#images_id").append('<input type="hidden" id="image-'+id+'" name="images[]" value="'+id+'">');
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
    	document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });

    // Handle before upload
    myDropzone.on("sending", function (file, xhr, formData) {
      	// add CSRF token
      	formData.append('_token', "{{ csrf_token() }}");
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
    });

    // supprime existing file
    @if($model->images)
    var images = {!! json_encode($model->images) !!};
    $(".remove-file").on('click', function(e) {
    	e.preventDefault();
    	var id = $(this).data('id');
      	// chercher l'image dans la collection
      	var result = $.grep(images, function(e){ return e.id == id; });
      	if(result.length == 0)
      		return false;
      	if(result.length == 1) {
      		var image = result[0];
      		if(image) {             
      			var mockFile = { 
      				name: image.file_name, 
      				size: 0, 
      				previewElement: $(this).parent().parent()[0]
      			};
      			myDropzone.removeFile(mockFile);
      		}
      	}
      });
    @endif

    // Handle on delete file
    myDropzone.on("removedfile", function (file) {
    	var id = file.previewElement.getAttribute('data-id');
   		var style = file.previewElement.getAttribute('data-style');
    	$("#image-"+id).remove();
    	$.ajax({
    		type: "delete",
    		url: "{{ route('admin.images.dropzone.delete') }}",
    		data: {
   				_method: "DELETE",
   				name: file.name,
   				id: id,
   				style: style
   			},
    		success: function(response){
    			myDropzone.options.maxFiles += 1;
    		}
    	});
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
    	document.querySelector("#total-progress").style.opacity = "0";
    });
</script>

<!-- jQuery UI Sortable -->
<script>
	$(function() {
		$(".ui-sortable").sortable({
			placeholder: "sort-highlight",
			handle: ".handle",
			forcePlaceholderSize: true,
			zIndex: 999999,
			axis: 'y', 
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				data += "&_token={{ csrf_token() }}";
				// Reorder with ajax
				$.ajax({
					data: data,
					type: 'POST',
					url: '{{ route("admin.images.dropzone.sort") }}'
				});
			}
		}).disableSelection();
		
	});
</script>
