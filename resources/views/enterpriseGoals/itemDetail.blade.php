<div class="panel panel-default">
	<div class="panel-heading">
		@include('enterpriseGoals.goalLabel', array('goaltype' => $data->dimention ))
		&nbsp;{{ $data->name }}
	</div>
	<div class="panel-body">
		<div class="col-md-7">
			<p>Description: {{ $data->description }}</p>
		</div>
			<div class="col-md-4">
				<div donut-chart donut-data='graph'></div>
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