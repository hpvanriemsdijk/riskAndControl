<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			@include('enterpriseGoals.goalLabel', array('goaltype' => $item->dimention ))
			&nbsp;<a href="{{ url('/enterpriseGoals', $item->id) }}" class="name">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>

<script>
	$('[data-toggle="tooltip"]').tooltip();
</script>