<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			<a href="{{ url('/' . $item->route) }}" class="name">{{ $item->label }}</a> 
		</div>
	</div>
	<div class="panel-body" class="description">
		<div><small>{{ $item->label }}</small></div>
	</div>

	@section('filter')
	<div class="btn-group" role="group" aria-label="...">
	  <button type="button" class="btn btn-default">Left</button>
	  <button type="button" class="btn btn-default">Middle</button>
	  <button type="button" class="btn btn-default">Right</button>
	</div>
	@endsection
</div>