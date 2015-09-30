@extends('app')

@section('css')
@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".panel-heading").dotdotdot({height: 30, wrap: 'letter'});
			$(".panel-body").dotdotdot({});
		});
	</script>
@endsection

@section('content')
<div class="row">
    @include('generic.list')
</div>
@endsection