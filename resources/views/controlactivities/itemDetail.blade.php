<div class="panel panel-default {{ App\Controlactivity::getEffectivityClass($data->effectivity) }}">
	<div class="panel-heading">
		<span class="label label-default">
			@if($data->key_control)<i class="fa fa-key"></i>@endif
			Control activity
		</span>
		&nbsp;<span data-toggle="tooltip" title="Internal reference">{{ $data->intref }}</span> 
		@if($data->extref) / <span data-toggle="tooltip" title="External reference">{{$data->extref }}</span> @endif - {{ $data->name }} 
		<div class="pull-right">
			@if($data->implementation_status == 'Not implemented')<span data-toggle="tooltip" title="Not implemented"><i class="fa fa-wrench" ></i></span>@endif
			@if($data->tests_expired && $data->last_tested)<span data-toggle="tooltip" title="Tests outdated"><i class="fa fa-clock-o"></i></span>@endif
			@if(!$data->last_tested)<span data-toggle="tooltip" title="Untested"><i class="fa fa-question-circle"></i></span>@endif
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<p>Description: {{ $data->description }}</p>
			<p>Control justification: {{ $data->justification }}</p>
			<p>Perform frequency: {{ $data->perform_frequency['label'] }}</p>
			<p>Test frequency: {{ $data->test_frequency['label'] }}</p>
			<p>Control type: {{ $data->control_execution }} - {{ $data->control_type }}</p>
			<p>Effectivity: {{$data->effectivity['label']}} <small><a href='#' onclick="$('.effectivity_calc').toggleClass('hidden');">Why?</a></small></p>
			<blockquote class="hidden effectivity_calc">
				<div class="row"><div class="col-md-3">Implementation status</div><div class="col-md-2">
					{{ $data->implementation_status }}
				</div></div>
				<div class="row"><div class="col-md-3">Tested</div><div class="col-md-2">
					@if($data->last_tested) Yes @else No @endif
				</div></div>
				<div class="row"><div class="col-md-3">Tests expired</div><div class="col-md-2">
					@if($data->tests_expired) Yes @else No @endif
				</div></div>
				<div class="row"><div class="col-md-3">Last tests conclusion</div><div class="col-md-2">
					{{ $data->last_test_conclusion['label'] }}
				</div></div>
			</blockquote>
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