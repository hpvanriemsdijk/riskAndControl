@extends('app')

@section('css')
@endsection

@section('javascript')
  <script type="text/javascript">
  $(document).ready(function() {
      $(".panel-body").dotdotdot({
          // configuration goes here
      });
  });
  </script>
@endsection

@section('content')
    @include('generic.list')
@endsection