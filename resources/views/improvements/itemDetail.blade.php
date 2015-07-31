<div class="panel panel-default {{ App\Improvement::getStatusClass($data->status) }}">
	<div class="panel-heading">
		<span class="label label-default">Improvements</span>
		{{ $data->name }}
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<p>Description: {{ $data->description }}</p>
			<p>Status: {{ $data->status['label'] }}</p>
			@if(isset($data->owner->id))<p>Owner: <a href="{{ url('/roles', $data->owner->id) }}" class="name">{{ $data->owner->name }}</a></p>@endif
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