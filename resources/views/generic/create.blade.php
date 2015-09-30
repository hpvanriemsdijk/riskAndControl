@if (isset($view))
	@include($view . '.create')
@else
	@include(Request::segment(1) . '.create')
@endif

<script>
    var data = {};
    $(document).ready(function() {
    	//Handle ajax post
        $('.submitBtn').on('click', function() {
            resetErrors();
            @if (isset($data))
                var url = '/{{explode(".", Route::current()->getName())[0]}}/' + {{$data->id}};
                //var url = {{$data->id}};
                var method = 'PUT';
            @else
                var url = '{{explode(".", Route::current()->getName())[0]}}';
                var method = 'POST';
            @endif
            
            $.each($('form input, form select, form textarea'), function(i, v) {
                if (v.type !== 'submit') {
                    data[v.name] = v.value;
                }
            }); //end each
            $.ajax({
                type: method,
                url: url,
                data: $("form").serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(resp) {
                    //Add msg
                    var msg = '<div class="form-group"><div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Great!</strong> You data have been saved. @if (!isset($data))Add some more or close this box to go back!@endif</div></div>';
                    $('form').before(msg);

                    //Clear form on add
                    @if (!isset($data))$('form').clearForm();@endif
                  
                    //Set post actions  
                    @if (isset($data))
                        //On edit, set reload page afer closing model
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        });                        
                    @else
                        //On add, add an new item to the list
                        var $newItems = $('<div class="list-item">' + resp + '</div>');        
                        $('#list').prepend($newItems).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });                         
                    @endif
                        

                    return false;
                },
                error: function(resp) {
                    //console.log(resp);
                    if(resp.status == 422) {
                      	$.each(resp.responseJSON, function(i, v) {
    		        		console.log(i + " => " + v); // view in console for error messages 
                            var msg = '<span class="help-block" for="'+i+'">'+v+'</span>';
                            $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').after(msg).parent('.form-group').addClass('has-error');
                        });
                        var keys = Object.keys(resp);
                        $('input[name="'+keys[0]+'"]').focus();
                        var msg = '<div class="form-group"><div class="alert alert-warning" role="alert"><strong>Whoops!</strong> The data contains some errors, please fix and submit again!</div></div>';
                        $('form').before(msg);
                    } else {
                        var msg = '<div class="form-group"><div class="alert alert-danger" role="alert"><strong>Snap!</strong> There was a problem saving your data.</div></div>';
                        $('form').before(msg);
                    }
                    return false;
                }
            });
            return false;
        });
    });

    jQuery.fn.clearForm = function(){
        //jQuery.fn.clearForm = function()
        var $form = $(this);
        $form.find('input:text, input:password, input:file, textarea').val('');
        $form.find('select option:selected').removeAttr('selected');
        $form.find('input:checkbox, input:radio').removeAttr('checked');

        return this;
    }; 

    function resetErrors() {
        $('.has-error').removeClass('has-error');
        $('.alert').parent('.form-group').remove();
        $('span.help-block').remove();
    }
</script>