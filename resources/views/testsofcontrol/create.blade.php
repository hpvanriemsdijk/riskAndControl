<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Test of control</h4>
</div>			
<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}
		<div class="form-group">
            <label class="control-label" for="name">Name</label>
			<input type="text" class="form-control box-sizing" name="name" placeholder="Name" @if(isset($data))value="{{$data->name}}"@endif>
		</div>
		<div class="form-group">
			<label class="control-label" for="test">test</label>
			<textarea class="form-control" name="test" rows="3">@if(isset($data)){{$data->test}}@endif</textarea>
		</div>		
		<div class="form-group">
			<label class="control-label" for="controlactivity_id">Controlactivity</label>
			<select name="controlactivity_id" id="controlactivity_id" class="form-control">
				@foreach($controlactivities as $key => $controlactivity)
				<option value='{{$key}}' @if(isset($data) && $data->controlactivity_id == $key) selected @endif>{{$controlactivity}}</option>
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
    	$("#controlactivity_id").select2();
    });
</script>