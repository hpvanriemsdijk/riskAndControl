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
					<label class="control-label" for="chance">Chance</label>
					<select name="chance" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->chance == $i) selected @endif>{{$i}}</option>
						@endfor
					</select>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="impact">Impact</label>
					<select name="impact" class="form-control">
						@for($i = 1; $i <= 5; $i++)
						<option value='{{$i}}' @if(isset($data) && $data->impact == $i) selected @endif>{{$i}}</option>
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