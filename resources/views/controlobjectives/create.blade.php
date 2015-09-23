<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">@if(isset($data))Edit @else Add @endif Controlobjective</h4>
</div>			<!-- /modal-header -->
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
					<label class="control-label" for="intref">Internal refference</label>
					<input type="text" class="form-control box-sizing" name="Intref" placeholder="intref" @if(isset($data))value="{{$data->intref}}"@endif>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="extref">External refference</label>
					<input type="text" class="form-control box-sizing" name="extref" placeholder="Extref" @if(isset($data))value="{{$data->extref}}"@endif>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label" for="description">Description</label>
			<textarea class="form-control" name="description" rows="3">@if(isset($data)){{$data->description}}@endif</textarea>
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