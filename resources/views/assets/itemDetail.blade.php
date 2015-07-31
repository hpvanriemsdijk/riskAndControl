<div class="panel panel-default">
	<div class="panel-heading">
		@include('assets.assetLabel', array('assettype' => $data->type )) 
		&nbsp;{{ $data->name }}
		<div class="pull-right">
			<span class="badge classification" data-toggle="tooltip" title="Continuity">{{ $data->continuity }}</span>
			<span class="badge classification" data-toggle="tooltip" title="Integrity">{{ $data->integrity }}</span>
			<span class="badge classification" data-toggle="tooltip" title="Availability">{{ $data->availability }}</span>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>{{ $data->description }}</p>
			<p>Owner: <a href="{{ url('/roles', $data->owner->id) }}" class="name">{{ $data->owner->name }}</a></p>
			<p>Maintainer: <a href="{{ url('/roles', $data->maintainer->id) }}" class="name">{{ $data->maintainer->name }}</a></p>
		</div>
		<div class="col-md-4">
			<div class="well well-sm" >
			<legend>Ancestors</legend>
			@foreach ($data->ancestors as $ancestor)
				@if($ancestor->id == $data->id)
				<div class="text-center">{{$ancestor->name}} (Current)</div>
				@else
				<div class="text-center"><a href="{{ url('/assets', $ancestor->id) }}" class="name">{{$ancestor->name}}</a></div>
				<div class="text-center"><i class="glyphicon glyphicon-arrow-down" ></i></div>
				@endif
			@endforeach
			</div>
		</div>
	</div>
	<div class="panel-footer clearfix">
		<small>
			<div class="pull-right">
				<i class="glyphicon glyphicon-asterisk" data-toggle="tooltip" title="Created"></i>{{ date('F d, Y', strtotime($data->created_at)) }} | 
				<i class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Last edited"></i> {{ date('F d, Y', strtotime($data->updated_at)) }}
			</div>
		</small>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();

		$('.classification').each(function(i, item) {
	    	var $item = $(item);
		    if( $item.text() < 3 ){
		        $item.addClass('low');
		    } else if( $item.text() < 5 ) {
		    	$item.addClass('medium');
		    } else {
		    	$item.addClass('high');
		    }
		});
	})
</script>