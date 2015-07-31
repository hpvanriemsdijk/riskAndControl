<div class="panel panel-default panel-list @if($item->active==0) disabled @endif">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Role</span>
			<a href="{{ url('/roles', $item->id) }}" class="name">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
	</div>
</div>