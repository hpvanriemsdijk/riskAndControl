<div class="panel panel-default panel-list 
		@if($item->active==0) disabled @else enabled @endif
		@if($item->objectives_not_met > 0) objectives_not_met @endif
		@if($item->objectives_partly_met > 0) objectives_partly_met @endif
		@if($item->objectives_met > 0) objectives_met @endif">
	<div class="panel-heading">
		<div>
			<span class="label label-default">Framework</span>
			<a href="{{ url('/controlframeworks', $item->id) }}" class="name">@if($item->name) {{ $item->name }} @else Nameless @endif</a> 
			<div class="pull-right headerLabel">
				<span class="badge high objectives_not_met" data-toggle="tooltip" title="Objectives not met">{{ $item->objectives_not_met }}</span>
				<span class="badge medium" data-toggle="tooltip" title="Objectives partly met">{{ $item->objectives_partly_met }}</span>
				<span class="badge low objectives_met" data-toggle="tooltip" title="Objectives fully met">{{ $item->objectives_met }}</span>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="description"><small>{{ $item->description }}</small></div>
		<div class="active hidden">{{ $item->active }}</div>
	</div>
</div>				