<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Role</h4>
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
			<label class="control-label" for="user_id">User</label>
			<select name="user_id" id="user_id" class="form-control">
				@foreach($users as $key => $user)
				<option value='{{$key}}' @if(isset($data) && $data->user_id == $key) selected @endif>{{$user}}</option>
				@endforeach
			</select>
		</div>
		<div class="checkbox">
			<label class="control-label" for="active">
				<input type="checkbox" name="active" value=1 @if(isset($data) && $data->active) checked @endif> Active role
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
    	$("#user_id").select2();
    });
</script>