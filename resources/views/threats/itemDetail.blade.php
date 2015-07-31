<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-default">Threat</span>
		&nbsp;{{ $data->name }}
		<div class="pull-right">
			<span class="badge net_risk" data-toggle="tooltip" title="Net risk">{{ $data->net_risk }}</span>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>{{ $data->description }}</p>
			<p>Risk: {{ $data->risk }} <small><a href='#' onclick="$('.risk_calc').toggleClass('hidden');">Calculation</a></small></p>
			<blockquote class="hidden risk_calc">
				<div class="row"><div class="col-md-3">Chance</div><div class="col-md-1">{{ $data->chance }}</div></div>
				<div class="row"><div class="col-md-3">Impact</div><div class="col-md-1">{{ $data->impact }} *</div></div>
				<div class="row"><div class="col-md-3 total">Risk</div><div class="col-md-1 total">{{ $data->risk }}</div></div>
			</blockquote>
			<p>Residual risk: {{ $data->residual_risk }} <small><a href='#' onclick="$('.rrisk_calc').toggleClass('hidden');">Calculation</a></small></p>
			<blockquote class="hidden rrisk_calc">
				<div class="row"><div class="col-md-3" data-toggle="tooltip" title="Total estimated effectiveness of control">TEEC</div><div class="col-md-1">{{ $data->teec }}% </div></div>
				<div class="row"><div class="col-md-3">Risk</div><div class="col-md-1">{{ $data->risk }} * </div></div>
				<div class="row"><div class="col-md-3 total">Mitigated risk</div><div class="col-md-1 total">{{ $data->risk * ($data->teec / 100) }}</div></div>
				<div class="row"><div class="col-md-3">Risk</div><div class="col-md-1">{{ $data->risk }} -</div></div>
				<div class="row"><div class="col-md-3 total">Residual risk</div><div class="col-md-1 total">{{ $data->residual_risk }}</div></div>
			</blockquote>
			<p>Net risk: {{ $data->net_risk }} <small><a href='#' onclick="$('.nrisk_calc').toggleClass('hidden');">Calculation</a></small></p>
			<blockquote class="hidden nrisk_calc">
				<div class="row"><div class="col-md-3" data-toggle="tooltip" title="Net total estimated effectiveness of control">Net TEEC</div><div class="col-md-1">{{ $data->net_teec }}% </div></div>
				<div class="row"><div class="col-md-3">Risk</div><div class="col-md-1">{{ $data->risk }} * </div></div>
				<div class="row"><div class="col-md-3 total">Mitigated risk</div><div class="col-md-1 total">{{ $data->risk * ($data->net_teec / 100) }}</div></div>
				<div class="row"><div class="col-md-3">Risk</div><div class="col-md-1">{{ $data->risk }} -</div></div>
				<div class="row"><div class="col-md-3 total">Net risk</div><div class="col-md-1 total">{{ $data->net_risk }}</div></div>
			</blockquote>
		</div>
		<div class="col-md-4">
			<div class="well well-sm" >
			<legend>Ancestors</legend>
			@foreach ($data->ancestors as $ancestor)
				@if($ancestor->id == $data->id)
				<div class="text-center">{{$ancestor->name}} (Current)</div>
				@else
				<div class="text-center"><a href="{{ url('/threats', $ancestor->id) }}" class="name">{{$ancestor->name}}</a></div>
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

<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();

		$('.net_risk').each(function(i, item) {
	    	var $item = $(item);
		    if( $item.text() < 10 ){
		        $item.addClass('low');
		    } else if( $item.text() < 15 ) {
		    	$item.addClass('medium');
		    } else {
		    	$item.addClass('high');
		    }
		});
	})
</script>