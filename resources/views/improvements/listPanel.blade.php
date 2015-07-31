<div class="panel panel-list {{ App\Improvement::getStatusClass($item->status) }}">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Improvement</span>
			<a href="{{ url('/improvements', $item->id) }}" class="name">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>