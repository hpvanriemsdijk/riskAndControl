<div class="panel panel-list {{ App\Controlactivity::getEffectivityClass($item->effectivity) }} @if($item->active==0) disabled @endif">
	<div class="panel-heading">
		<div>
			<span class="label label-default">
				@if($item->key_control)<i class="fa fa-key"></i>@endif
				Control activity
			</span>
			&nbsp;<a href="{{ url('/controlactivities', $item->id) }}">{{ $item->name }}</a> 
			<div class="pull-right">
				@if($item->implementation_status == 'Not implemented')<span data-toggle="tooltip" title="Not implemented"><i class="fa fa-wrench" ></i></span>@endif
				@if($item->tests_expired && $item->last_tested)<span data-toggle="tooltip" title="Tests outdated"><i class="fa fa-clock-o"></i></span>@endif
				@if(!$item->last_tested && $item->implementation_status != 'Not implemented')<span data-toggle="tooltip" title="Untested"><i class="fa fa-question-circle"></i></span>@endif
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div><small>{{ $item->description }}</small></div>
	</div>
</div>