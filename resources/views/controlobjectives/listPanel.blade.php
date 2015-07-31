<div class="panel panel-list {{ App\Controlobjective::getEffectivityClass($item->effectivity) }} @if($item->active==0) disabled @endif">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Control objective</span>
			<a href="{{ url('/controlobjectives', $item->id) }}">{{ $item->name }}</a> 
			<div class="pull-right">
				@if(isset($item->eec))
					<span class="badge" data-toggle="tooltip" title="Estimated effectiveness of control">{{ $item->eec }}%</span>
				@endif
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div><small>{{ $item->description }}</small></div>
	</div>
</div>