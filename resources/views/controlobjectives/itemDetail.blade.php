<div class="panel panel-default {{ App\Controlobjective::getEffectivityClass($data->effectivity) }}">
	<div class="panel-heading">
		<span class="label label-default">Control objective</span>
		<span data-toggle="tooltip" title="Internal reference">{{ $data->intref }}</span> 
		@if($data->extref) / <span data-toggle="tooltip" title="External reference">{{$data->extref }}</span> @endif - {{ $data->name }} 
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>{{$data->description}}</p>
			<p>Effectivity: {{$data->effectivity['label']}} <small><a href='#' onclick="$('.effectivity_calc').toggleClass('hidden');">Why?</a></small></p>
			<blockquote class="hidden effectivity_calc">
				<div class="row"><div class="col-md-3">Not implemented activities</div><div class="col-md-1">
					{{ $data->activies_planned['total'] }}
					({{ $data->activies_planned['key_control'] }} <i class="fa fa-key"></i>)
				</div></div>
				<div class="row"><div class="col-md-3">Activities untested</div><div class="col-md-1">
					{{ $data->untested['total'] }}
					({{ $data->untested['key_control'] }} <i class="fa fa-key"></i>)
				</div></div>
				<div class="row"><div class="col-md-3">Activity tests expired</div><div class="col-md-1">
					{{ $data->tests_expired['total'] }}
					({{ $data->tests_expired['key_control'] }} <i class="fa fa-key"></i>)
				</div></div>
				<div class="row"><div class="col-md-3">Ineffective activities</div><div class="col-md-1">
					{{ $data->activities_not_effective['total'] }} 
					({{ $data->activities_not_effective['key_control'] }} <i class="fa fa-key"></i>)
				</div></div>
				<div class="row"><div class="col-md-3">Partly effective activities</div><div class="col-md-1">
					{{ $data->activities_partly_effective['total'] }} 
					({{ $data->activities_partly_effective['key_control'] }} <i class="fa fa-key"></i>) +
				</div></div>
				<div class="row"><div class="col-md-3 total">Controls lacking assurance</div><div class="col-md-1 total">
					{{ $data->untested['total'] + $data->activies_planned['total'] + $data->tests_expired['total'] + $data->activities_not_effective['total'] + $data->activities_partly_effective['total'] }}
					({{ $data->untested['key_control'] + $data->activies_planned['key_control'] + $data->tests_expired['key_control'] + $data->activities_not_effective['key_control'] + $data->activities_partly_effective['key_control'] }} <i class="fa fa-key"></i>)
				</div></div>
			</blockquote>
		</div>
		<div class="col-md-4">
			<div class="well well-sm" >
				<div id="objective_effectiveness" style="height: 250px;"></div>
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

<script>
	$(document).ready(function() {
		objective_effectiveness_donut = Morris.Donut({
			element: 'objective_effectiveness',
			data: [
				{label: "Not implemented", value: {{ $data->activies_planned['total'] }}},
				{label: "Untested activies", value: {{ $data->untested['total'] }}},
				{label: "Activies with expired test", value: {{ $data->tests_expired['total'] }}},
				{label: "Ineffective activies", value: {{ $data->activities_not_effective['total'] }}},
				{label: "Partly effective activies", value: {{ $data->activities_partly_effective['total'] }}},
				{label: "Effective activies", value: {{ $data->activities_efective['total'] }}}
			],
			colors: ['#777777','#aaaaaa', '#dddddd','#d9534f','#f0ad4e','#5cb85c']
		});		
	})
</script>