<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif User</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}
		<div class="form-group">
            <label class="control-label" for="name">Name</label>
			<input type="text" class="form-control box-sizing" name="name" placeholder="Name" @if(isset($data))value="{{$data->name}}"@endif>
		</div>
		<div class="form-group">
            <label class="control-label" for="email">E-mail</label>
			<input type="text" class="form-control box-sizing" name="email" placeholder="email" @if(isset($data))value="{{$data->email}}"@endif>
		</div>
		<div class="form-group">
            <label class="control-label" for="password">Password</label>
			<input type="password" class="form-control box-sizing" name="password">
		</div>
		<div class="form-group">
            <label class="control-label" for="password_confirmation">Validate password</label>
			<input type="password" class="form-control box-sizing" name="password">
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