<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Asset</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}
		<div class="form-group">
            <label class="control-label" for="name">Name</label>
			<input type="text" class="form-control box-sizing" name="name" placeholder="Name" @if(isset($data))value="{{$data->name}}"@endif>
		</div>
		<div class="form-group">
			<label class="control-label" for="description">Description</label>
			<textarea class="form-control" name="description" rows="3">@if(isset($data)){{$data->description}}@endif</textarea>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="owner_id">Owner</label>
					<select name="owner_id" id="owner_id" class="form-control">
						@foreach($roles as $key => $role)
						<option value='{{$key}}' @if(isset($data) && $data->owner_id == $key) selected @endif>{{$role}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="maintainer_id">Maintainer</label>
					<select name="maintainer_id" id="maintainer_id" class="form-control">
						@foreach($roles as $key => $role)
						<option value='{{$key}}' @if(isset($data) && $data->maintainer_id == $key) selected @endif>{{$role}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="maintainer_id">Continuity rating</label>
					<select name="continuity" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->continuity == $key) selected @endif>{{$i}}</option>
						@endfor
					</select>
				</div>	
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="maintainer_id">Availability rating</label>
					<select name="availability" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->continuity == $key) selected @endif>{{$i}}</option>
						@endfor
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="maintainer_id">Integrity rating</label>
					<select name="integrity" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->continuity == $key) selected @endif>{{$i}}</option>
						@endfor
					</select>
				</div>	
			</div>
		</div>

		<div class="form-group">
			<label class="control-label" for="type">Type</label>
			<select name="type" class="form-control">
				@foreach($assetTypes as $key => $assetType)
				<option value='{{$key}}' @if(isset($data) && $data->type == $key) selected @endif>{{$assetType}}</option>
				@endforeach
			</select>
		</div>		
		<div class="checkbox">
			<label class="control-label" for="active">
				<input type="checkbox" name="active" value=1 @if(isset($data) && $data->active) checked @endif> Active framework
			</label>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-primary submitBtn">Save changes</button>
</div>

<script>
    var data = {};
    $(document).ready(function() {
    	//Set select2
    	$("#owner_id, #maintainer_id").select2();
    });
</script>