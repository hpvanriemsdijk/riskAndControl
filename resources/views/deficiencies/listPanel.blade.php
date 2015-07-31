<div class="panel panel-list {{ App\Deficiency::getFollowupClass($item->followup) }}">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Deficientcy</span>
			<a href="{{ url('/deficiencies', $item->id) }}" class="name">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>