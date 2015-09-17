<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">Add Controlframework</h4>
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
		<div class="form-group">
			<label class="control-label" for="owner_id">Owner</label>
			<select name="owner_id" class="form-control">
				@foreach($roles as $key => $role)
				<option value='{{$key}}' @if(isset($data) && $data->owner_id == $key) selected @endif>{{$role}}</option>
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
    	$("#owner").select2();
    });
</script>