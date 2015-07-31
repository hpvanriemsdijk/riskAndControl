<div class="panel panel-default panel-list">
	<div class="panel-heading">
		<div>
			<span class="label label-default">User</span>
			<a href="{{ url('/users', $item->id) }}">{{ $item->name }}</a> 
		</div>
	</div>
	<div class="panel-body">
		<div><small>{{$item->email}}</small></div>
	</div>
</div>