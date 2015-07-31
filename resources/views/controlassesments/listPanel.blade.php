<div class="panel panel-list {{ App\Controlassesment::getConclusionClass($item->conclusion) }}">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Control assesment</span>
			<a href="{{ url('/controlassesments', $item->id) }}" class="name">{{ $item->start }} - {{ $item->finish }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->finding }}</small></div>
	</div>
</div>