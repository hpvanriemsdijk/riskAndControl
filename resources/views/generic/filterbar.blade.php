<div class="row margin-bottom-md">
	<div class="container">
		<div class="row row-no-padding">
			<div class="filterbar">
				<div class="input-group">
					<div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
					<input type="text" class="form-control" id="quicksearch" placeholder="Search" />
				</div>      
			</div> 

			@if(isset($filter))
				@if(isset($filter['sortFields']))
					<div class="input-group filterbar">
						<span class="input-group-btn">
				        	<button class="btn btn-default sortOrder" type="button"><i class="glyphicon glyphicon-sort-by-attributes"></i></button>
				      	</span>
						<div class="input-group-btn">
							<button type="button" class="btn btn-default dropdown-toggle" id="sort-action-btn" data-toggle="dropdown">
								{{ $filter['sortFields'][0]['label'] }} <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								@foreach($filter['sortFields'] as $sortField)
								<li><a href="#" class='sort-action' data-sort-by="{{$sortField['value']}}">{{$sortField['label']}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif

				@if(isset($filter['filterGroups']))
					@foreach($filter['filterGroups'] as $filterGroup)
						<div class="input-group filterbar" data-filter-group="{{$filterGroup['id']}}" style="float: right; display: block;">
							<div class="input-group-addon">
								{{$filterGroup['label']}}
							</div>
					      	<div class="input-group-btn">
					      		<button type="button" 
									class="btn btn-default filterAction active" 
									data-filter=""
									filter-group="{{$filterGroup['id']}}">All</button>
								@foreach($filterGroup['items'] as $filterItem)
								<button type="button" 
									class="btn btn-default filterAction" 
									data-filter="{{$filterItem['value']}}"
									filter-group="{{$filterGroup['id']}}">{{$filterItem['label']}}</button>
								@endforeach
							</div>
			      		</div>
					@endforeach
				@endif
			@endif
		</div>
	</div>
</div>	

<script type="text/javascript">
	$(document).ready(function() {
		//Init Sort and order
		var $container = $('#list');
		var qsRegex;
		var filters = {};
		var filterValue = "";

		$container.isotope({
			// options
			itemSelector: '.list-item',
			@if(isset($filter['sortFields']))
			getSortData: {
				@foreach($filter['sortFields'] as $sortField)
				{{$sortField['value']}}: '.{{$sortField['value']}}',
				@endforeach
			},
			sortBy: "{{ $filter['sortFields'][0]['value'] }}",
			filter: function() {
				return qsRegex ? $(this).text().match( qsRegex ) : true;
			}
			@endif
		});

		//Set sort object
		$('.sort-action').click(function(e) {
			var sortByValue = $(this);
			sort(sortByValue);
		});  

		//Set sort order
		$('.sortOrder').click(function(e) {
		    var $this = $(this);

		    // Turn 'selected' class on/off
		    $this.toggleClass('asc');
		    $this.find( "i" ).toggleClass("glyphicon-sort-by-attributes glyphicon-sort-by-attributes-alt");

		    //Sort
		    sort();
		    return false;
		});

		function sort(sortByValue){
			var sortByValue = andClose || null;

			if(!sortByValue){
				sortByValue = $('.sort-action');
			}else{
				$("#sort-action-btn").html(sortByValue.text() + ' <span class="caret"></span>');
			}

			if($('.sortOrder').hasClass('asc')){
				valAscending = false;
			}else{
				valAscending = true;
			}
						
			$container.isotope({ sortBy: sortByValue.attr('data-sort-by'), sortAscending : valAscending });
		}

		// use value of search field to filter
		var $quicksearch = $('#quicksearch').keyup( debounce( function() {
			qsRegex = new RegExp( $quicksearch.val(), 'gi' );
			applyFilter();
		}, 200 ) );

		$('.filterAction').click(function() {
			$(this).parent().find('.filterAction').removeClass('active');
			$(this).addClass('active');

			var filterGroup = $(this).attr('filter-group');
			filters[ filterGroup ] = $(this).attr('data-filter');
			filterValue = concatValues( filters );

			applyFilter();			
		});

		function applyFilter(){
			$container.isotope({
				filter: function() {
					if($(this).find(filterValue).length > 0 || filterValue == ""){
						return qsRegex ? $(this).text().match( qsRegex ) : true;
					}
				}
			});
		}
		
		// flatten object by concatting values
		function concatValues( obj ) {
			var value = '';
				for ( var prop in obj ) {
				value += obj[ prop ];
			}
			return value;
		}

		// debounce so filtering doesn't happen every millisecond
		function debounce( fn, threshold ) {
			var timeout;
			return function debounced() {
				if ( timeout ) {
					clearTimeout( timeout );
				}
				function delayed() {
					fn();
					timeout = null;
				}
				timeout = setTimeout( delayed, threshold || 100 );
			}
		}
	});
</script>