<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Threat</h4>
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
					<label class="control-label" for="threatTarget">Threat target</label>
					<select name="threatTarget" id="threatTarget" class="form-control">
						<option value="" disabled selected>Select your option</option>
						<option value='enterpriseGoal_id'>Enterprise Goal</option>
						<option value='process_id'>Process</option>
						<option value='asset_id'>Asset</option>
					</select>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="process_id">Process</label>
					<select name="process_id" id="process_id" class="form-control">
						@foreach($processes as $key => $process)
						<option value='{{$key}}' @if(isset($data->process_id)) selected @endif>{{$process}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" for="asset_id">Assets</label>
					<select name="asset_id" id="asset_id" class="form-control">
						@foreach($assets as $key => $asset)
						<option value='{{$key}}' @if(isset($data->asset_id)) selected @endif>{{$asset}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" for="enterpriseGoal_id">Enterprise Goal</label>
					<select name="enterpriseGoal_id" id="enterpriseGoal_id" class="form-control">
						@foreach($enterpriseGoals as $key => $enterpriseGoal)
						<option value='{{$key}}' @if(isset($data->enterpriseGoals_is)) selected @endif>{{$enterpriseGoal}}</option>
						@endforeach
					</select>
				</div>
			</div>			
		</div>	

		
		
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="chance">Chance</label>
					<select name="chance" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->chance == $key) selected @endif>{{$i}}</option>
						@endfor
					</select>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="impact">Impact</label>
					<select name="impact" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->impact == $key) selected @endif>{{$i}}</option>
						@endfor
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
    	$("#process_id").select2();
    	$("#asset_id").select2();
    	$("#enterpriseGoal_id").select2();

    	hideSelect = function(){
    		$('#process_id').select2("container").parent(".form-group").hide();
    		$('#asset_id').select2("container").parent(".form-group").hide();
    		$('#enterpriseGoal_id').select2("container").parent(".form-group").hide();
    	}

    	$('#threatTarget').change(function(){
    		hideSelect();
	        $('#' + $(this).val()).select2("container").parent(".form-group").show();
	    });

	    hideSelect();
    });
</script>