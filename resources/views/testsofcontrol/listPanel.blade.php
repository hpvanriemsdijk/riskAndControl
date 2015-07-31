<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Test of control</span>
			<a href="{{ url('/testsofcontrol', $item->id) }}" class="name">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->test }}</small></div>
	</div>
</div>