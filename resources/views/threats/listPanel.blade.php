<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Threat</span>
			<a href="{{ url('/threats', $item->id) }}">{{ $item->name }}</a> 
			<div class="pull-right">
				<span class="badge net_risk" data-toggle="tooltip" title="Net risk">{{ $item->net_risk }}</span>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div><small>{{ $item->description }}</small></div>
	</div>
</div>

<script>
	$('[data-toggle="tooltip"]').tooltip();

	$('.net_risk').each(function(i, item) {
    	var $item = $(item);
	    if( $item.text() < 10 ){
	        $item.addClass('low');
	    } else if( $item.text() < 15 ) {
	    	$item.addClass('medium');
	    } else {
	    	$item.addClass('high');
	    }
	});
</script>