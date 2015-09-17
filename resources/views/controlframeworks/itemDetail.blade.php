<div class="panel panel-default">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Framework</span>
			{{ $data->name }}
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>Description: {{ $data->description }}</p>
			@if(isset($data->owner->id))<p>Owner: <a href="{{ url('/roles', $data->owner->id) }}" class="name">{{ $data->owner->name }}</a></p>@endif
		</div>
		<div class="col-md-4">
			<div class="well well-sm" >
				<div id="objectives_status" style="height: 250px;"></div>
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
		$(function () {
			objectives_status_donut = Morris.Donut({
			  element: 'objectives_status',
			  data: [
			    {label: "Objectives not met", value: {{ $data->objectives_not_met }}},
			    {label: "Objectives partly met", value: {{ $data->objectives_partly_met }}},
			    {label: "Objectives fully met", value: {{ $data->objectives_met }}}
			  ],
		      colors: ['#d9534f','#f0ad4e','#5cb85c'],
			});	
		})
	})
</script>