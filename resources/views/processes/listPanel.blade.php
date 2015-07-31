<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Proces</span>
			<a href="{{ url('/processes', $item->id) }}" class="name">{{ $item->ref }} - {{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>