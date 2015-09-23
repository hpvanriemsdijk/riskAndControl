<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Controlassesment</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
	<form>
		{!! csrf_field() !!}

		<div class="row">
			<div class="col-md-5">
				<label class="control-label" for="start">Start</label>
				<input type="text" class="form-control box-sizing" name="start" id="start" @if(isset($data))value="{{$data->name}}"@endif>
			</div>
			<div class="col-md-5">
				<label class="control-label" for="finish">Finish</label>
				<input type="text" class="form-control box-sizing" name="finish" id="finish" @if(isset($data))value="{{$data->name}}"@endif>
			</div>			
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="auditor_id">Auditor</label>
					<select name="auditor_id" id="auditor_id" class="form-control">
						@foreach($users as $key => $user)
						<option value='{{$key}}' @if(isset($data) && $data->auditor_id == $key) selected @endif>{{$user}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="auditee_id">Auditee</label>
					<select name="auditee_id" id="auditee_id" class="form-control">
						@foreach($users as $key => $user)
						<option value='{{$key}}' @if(isset($data) && $data->auditee_id == $key) selected @endif>{{$user}}</option>
						@endforeach
					</select>
				</div>
			</div>			
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="approveer_id">Approveer</label>
					<select name="approveer_id" id="approveer_id" class="form-control">
						@foreach($users as $key => $user)
						<option value='{{$key}}' @if(isset($data) && $data->approveer_id == $key) selected @endif>{{$user}}</option>
						@endforeach
					</select>
				</div>
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label" for="controlactivity_id">Controlactivity</label>
			<select name="controlactivity_id" id="controlactivity_id" class="form-control">
				@foreach($controlactivities as $key => $controlactivity)
				<option value='{{$key}}' @if(isset($data) && $data->controlactivity_id == $key) selected @endif>{{$controlactivity}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label class="control-label" for="finding">finding</label>
			<textarea class="form-control" name="finding" rows="3">@if(isset($data)){{$data->finding}}@endif</textarea>
		</div>

		<div class="form-group">
			<label class="control-label" for="conclusion">Conclusion</label>
			<select name="conclusion" class="form-control">
				@foreach($conclusions as $key => $conclusion)
				<option value='{{$key}}' @if(isset($data) && $data->conclusion == $key) selected @endif>{{$conclusion}}</option>
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
	$(document).ready(function() {
    	//Set select2
    	$("#auditor_id, #auditee_id, #approveer_id, #controlactivity_id").select2();

    	//Set datepicker
    	$('#start, #finish').datepicker({});
    });
</script>