<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			@include('assets.assetLabel', array('assettype' => $item->type ))
			&nbsp;<a href="{{ url('/assets', $item->id) }}" class="name">{{ $item->name }}</a> 
			<div class="pull-right">
				<span class="badge classification" data-toggle="tooltip" title="Continuity">{{ $item->continuity }}</span>
				<span class="badge classification" data-toggle="tooltip" title="Integrity">{{ $item->integrity }}</span>
				<span class="badge classification" data-toggle="tooltip" title="Availability">{{ $item->availability }}</span>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>

<script>
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
</script>