<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Asset</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
		            <label class="control-label" for="name">Name</label>
					<input type="text" class="form-control box-sizing" name="name" placeholder="Name" @if(isset($data))value="{{$data->name}}"@endif>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
		            <label class="control-label" for="ref">Refference</label>
					<input type="text" class="form-control box-sizing" name="ref" placeholder="Name" @if(isset($data))value="{{$data->ref}}"@endif>
				</div>
			</div>
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