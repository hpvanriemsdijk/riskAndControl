<div class="panel panel-default {{ App\Controlassesment::getConclusionClass($data->conclusion) }}">
	<div class="panel-heading">
		<span class="label label-default">Control assesment</span>
		{{ $data->start }} - {{ $data->finish }}
	</div>
	<div class="panel-body">
		<div class="col-md-12">		
			<p>Finding: {{ $data->finding }}</p>
			<p>Conclusion: {{ $data->conclusion['label'] }}</p>
			@if(isset($data->auditor->id))<p>Auditor: <a href="{{ url('/users', $data->auditor->id) }}" class="name">{{ $data->auditor->name }}</a></p>@endif
			@if(isset($data->auditee->id))<p>Auditee: <a href="{{ url('/users', $data->auditee->id) }}" class="name">{{ $data->auditee->name }}</a></p>@endif
			@if(isset($data->approveer->id))<p>Approveer: <a href="{{ url('/users', $data->approveer->id) }}" class="name">{{ $data->approveer->name }}</a></p>@endif
			@if(isset($data->controlactivity->id))<p>Controlactivity: <a href="{{ url('/controlactivities', $data->controlactivity->id) }}" class="name">{{ $data->controlactivity->name }}</a></p>@endif
			@if(isset($data->threat->id))<p>Threat: <a href="{{ url('/threats', $data->threat->id) }}" class="name">{{ $data->threat->name }}</a></p>@endif
		</div>
	</div>
</div>