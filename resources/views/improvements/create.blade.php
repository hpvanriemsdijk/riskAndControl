<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Improvement</h4>
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
			<select name="owner_id" id="owner_id" class="form-control">
				@foreach($roles as $key => $role)
				<option value='{{$key}}' @if(isset($data) && $data->owner_id == $key) selected @endif>{{$role}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label class="control-label" for="status">Status</label>
			<select name="status" class="form-control">
				@foreach($improvementStatus as $key => $status)
				<option value='{{$key}}' @if(isset($data) && $data->status == $key) selected @endif>{{$status}}</option>
				@endforeach
			</select>
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
    	$("#owner_id").select2();
    });
</script>