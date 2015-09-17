@include('generic.filterbar')

@if(session('status'))
  <div class="row">
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ session('status') }}
    </div>
  </div>
@endif

<div class="row row-no-padding">
  @if (!count($data))
  <div class="jumbotron">
    <h1>There is nothing here!</h1>
    <p>You might whant to <a class="btn btn-primary" href="#" role="button">add some</a></p>
  </div>
  @else
    <div id="list">
      @foreach ($data as $item)
      <div class="list-item">  
        @if (isset($view))
          @include($view . '.listPanel')
        @else
          @include(Request::segment(count(Request::segments())) . '.listPanel')
        @endif
      </div>
      @endforeach
  </div>
  @endif
</div>  

{{--
This code will stop Morris from wokrking in item detail view 
<script type="text/javascript">
  //Init dotdotdot (Shortner)
  $(document).ready(function() {
    $(".panel-body").dotdotdot({
        // configuration goes here
    });
  });
</script>
--}}