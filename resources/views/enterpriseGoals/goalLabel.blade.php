<span class="label label-default" data-toggle="tooltip" title="Goal type: {{ App\EnterpriseGoal::getGoalTypeLabel($goaltype) }}">
	@if($goaltype == 0)
		<i class="glyphicon glyphicon-eur" ></i>
	@elseif($goaltype== 1)
		<i class="glyphicon glyphicon-user" ></i>
	@elseif($goaltype == 2)
		<i class="glyphicon glyphicon-repeat" ></i>
	@elseif($goaltype == 3)
		<i class="glyphicon glyphicon-education" ></i>
	@endif
	Enterprise Goal
</span>