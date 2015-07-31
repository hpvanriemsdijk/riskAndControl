@extends('app')

@section('css')
@endsection

@section('javascript')
<script>
	$(document).ready(function() {
		//Tooltip
		$('[data-toggle="tooltip"]').tooltip();

		//Select tab
		$('[data-toggle="tabajax"]').click(function(e) {
		    var $this = $(this),
		        loadurl = $this.attr('href'),
		        targ = $this.attr('data-target');

		    $.get(loadurl, function(data) {
		        $(targ).html(data);

		        $('#list').isotope({
					itemSelector: '.list-item'
		    	});
		    });

		    $this.tab('show');
		    return false;
		});

		// load first or activated tab content
		if( $("li.active").length ) {
			var $this = $("li.active > a"),
				loadurl = $this.attr('href'),
			    targ = $this.attr('data-target');
		}else{
			var $this = $('a[data-toggle="tabajax"]:first'),
				loadurl = $this.attr('href'),
		   		targ = $this.attr('data-target');
		   		$this.parent().addClass('active');
		}

		$.get(loadurl, function(data) {
		    $(targ).html(data);
		});

		//Fix issue with graphs
		//morris.redraw();
	});
</script>
@endsection

@section('content')
{{-- WARNING SECTION --}}
@if(isset($data->active) && $data->active == 0)
<div class="row">
	<div class="alert alert-warning alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>Inactive: </strong>This item is set inactive.
	</div>
</div>
@endif

@if($data->trashed())
<div class="row">
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>Deleted: </strong>This item is deleted.
	</div>
</div>
@endif

@if(isset($data->warnings))
	@foreach ($data->warnings as $warning)
	<div class="row">
		<div class="alert alert-{{$warning['severity']}} alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> {{$warning['label']}}
		</div>
	</div>
	@endforeach
@endif
{{--END WARNING SECTION --}}

<div class="row">
	@include(Request::segments()[0] . '.itemDetail')	
</div>

@if(isset($childModels) && count($childModels))
<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="myTabs">
	@foreach ($childModels as $childModel)
	<li @if(isset($childModel['active']))class="active"@endif>
		<a href="{{ url('/'. Request::segments()[0] . 
					'/' . Request::segments()[1] .
					'/'. $childModel['model'] ) }}" 
			data-target="#tab-content" 
			aria-controls="{{ $childModel['label'] }}" 
			data-toggle="tabajax" 
			rel="tooltip">
			{{ $childModel['label'] }}
		</a>
	</li>
	@endforeach
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="tab-content">...</div>
	</div>
</div>
@endif
@endsection