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

			$this.tab('show');

		    $(targ).hide(function() {
				$('.loader').fadeIn("Slow");

				 $.get(loadurl, function(data) {
			    	$(targ).html(data);

					$('.loader').fadeOut("Slow", function() {
						$(targ).show();

						$('#list').isotope({
							itemSelector: '.list-item'
				    	});
					});	
			    });
			});	  
		    
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
	});
	
	function deleteItem(id) {
		if (confirm('Are you sure you want to delete this item?')) {
		    $.ajax({
		        type: "DELETE",
		        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        url: '/{{Request::segments()[0]}}/' + id, 
		        success: function(affectedRows) {
		            window.location.href = '/{{Request::segments()[0]}}/';
		        }
		    });
		}	
	};
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
		<!-- messages -->
		<div class="loader">
			<div class="alert alert-info" role="alert">
				<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...
			</div>
		</div>

		<div class="tab-pane active" id="tab-content"></div>
	</div>

	
</div>
@endif
@endsection