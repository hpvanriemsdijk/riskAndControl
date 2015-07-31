<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-default">RO</span>
		{{ $data->name }}
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<p>Description: {{ $data->description }}</p>
			@if(isset($data->user->id))<p>User: <a href="{{ url('/users', $data->user->id) }}" class="name">{{ $data->user->name }}</a></p>@endif
		</div>
	</div>
	<div class="panel-footer clearfix">
		<small>
			<div class="pull-right">
				<i class="glyphicon glyphicon-asterisk" data-toggle="tooltip" title="Created"></i>{{ date('F d, Y', strtotime($data->created_at)) }} | 
				<i class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Last edited"></i> {{ date('F d, Y', strtotime($data->updated_at)) }}
			</div>
		</small>
	</div>
</div>