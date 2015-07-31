<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-default">Proces</span>
		{{ $data->ref }} - {{ $data->name }}
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>{{ $data->description }}</p>
			@if(isset($data->owner->id))<p>Owner: <a href="{{ url('/roles', $data->owner->id) }}" class="name">{{ $data->owner->name }}</a></p>@endif
			@if(isset($data->maintainer->id))<p>Maintainer: <a href="{{ url('/roles', $data->maintainer->id) }}" class="name">{{ $data->maintainer->name }}</a></p>@endif
		</div>
		<div class="col-md-4">
			<div class="well well-sm" >
			<legend>Ancestors</legend>
			@foreach ($data->ancestors as $ancestor)
				@if($ancestor->id == $data->id)
				<div class="text-center">{{$ancestor->name}} (Current)</div>
				@else
				<div class="text-center"><a href="{{ url('/processes', $ancestor->id) }}" class="name">{{$ancestor->name}}</a></div>
				<div class="text-center"><i class="glyphicon glyphicon-arrow-down" ></i></div>
				@endif
			@endforeach
			</div>
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