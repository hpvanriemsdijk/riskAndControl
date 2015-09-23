<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Controlactivity</h4>
</div>			
<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}
		<div class="form-group">
            <label class="control-label" for="name">Name</label>
			<input type="text" class="form-control box-sizing" name="name" placeholder="Name" @if(isset($data))value="{{$data->name}}"@endif>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
		            <label class="control-label" for="intref">intref</label>
					<input type="text" class="form-control box-sizing" name="intref" placeholder="intref" @if(isset($data))value="{{$data->intref}}"@endif>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
		            <label class="control-label" for="extref">extref</label>
					<input type="text" class="form-control box-sizing" name="extref" placeholder="extref" @if(isset($data))value="{{$data->extref}}"@endif>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label" for="description">Description</label>
			<textarea class="form-control" name="description" rows="3">@if(isset($data)){{$data->description}}@endif</textarea>
		</div>
		<div class="form-group">
			<label class="control-label" for="justification">Justification</label>
			<textarea class="form-control" name="justification" rows="3">@if(isset($data)){{$data->justification}}@endif</textarea>
		</div>
		<div class="form-group">
			<label class="control-label" for="owner_id">Owner</label>
			<select name="owner_id" id="owner_id" class="form-control">
				@foreach($roles as $key => $role)
				<option value='{{$key}}' @if(isset($data) && $data->owner_id == $key) selected @endif>{{$role}}</option>
				@endforeach
			</select>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="perform_frequency">Perform frequency</label>
					<select name="perform_frequency" class="form-control">
						@foreach($performFrequencies as $key => $performFrequency)
						<option value='{{$key}}' @if(isset($data) && $data->perform_frequency == $key) selected @endif>{{$performFrequency}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="test_frequency">Test Frequency</label>
					<select name="test_frequency" class="form-control">
						@foreach($performFrequencies as $key => $performFrequency)
						<option value='{{$key}}' @if(isset($data) && $data->test_frequency == $key) selected @endif>{{$performFrequency}}</option>
						@endforeach
					</select>
				</div>	
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="control_type">Control Type</label>
					<select name="control_type" class="form-control">
						@foreach($controlTypes as $key => $controlType)
						<option value='{{$key}}' @if(isset($data) && $data->control_type == $key) selected @endif>{{$controlType}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="control_execution">Control Execution</label>
					<select name="control_execution" class="form-control">
						@foreach($controlExecution as $key => $controlExecute)
						<option value='{{$key}}' @if(isset($data) && $data->control_execution == $key) selected @endif>{{$controlExecute}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="implementation_status">Implementation Status</label>
					<select name="implementation_status" class="form-control">
						@foreach($implementationStatus as $key => $implementationState)
						<option value='{{$key}}' @if(isset($data) && $data->implementation_status == $key) selected @endif>{{$implementationState}}</option>
						@endforeach
					</select>
				</div>	
			</div>
		</div>	

		<div class="checkbox">
			<label class="control-label" for="active">
				<input type="checkbox" name="active" value=1 @if(isset($data) && $data->active) checked @endif> Active Controlactivity
			</label>
		</div>
		<div class="checkbox">
			<label class="control-label" for="key_control">
				<input type="checkbox" name="key_control" value=1 @if(isset($data) && $data->key_control) checked @endif> Key Control
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
    	$("#owner_id").select2();
    });
</script>