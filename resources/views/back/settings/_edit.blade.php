{!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'edit-form']) !!}

@if($setting->is_array)

@for($i = 0; $i < config('settings.max_'.$setting->key, 1); $i++)
<div class="form-group">
	<label for="value" class="control-label">{{ trans('settings.'.$setting->key) .' '. ($i+1)}} </label>
	<input type="text" class="form-control" name="value[]" value="{{ isset($values[$i]) ? $values[$i] : null }}">
</div>
@endfor

@else
@if($setting->key == 'full_address')

<div class="form-group">
	{{-- <label for="value" class="control-label">{{ trans('settings.'.$setting->key)}} </label> --}}
	<textarea class="form-control" name="value" id="value" rows="10">{!! $setting->value !!}</textarea>
</div>

@else
<div class="form-group">
	<input type="text" class="form-control" name="value" value="{{ $setting->value }}">
</div>
@endif
@endif
<div class="form-group">
	<button class="btn btn-primary" id="btn-edit" type="submit"><i class="fa fa-save"></i> Enregistrer</button>
</div>
{!! Form::close() !!}