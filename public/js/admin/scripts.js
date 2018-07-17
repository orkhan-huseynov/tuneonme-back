$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.delete-link').click(function(){
    var delete_url = $(this).attr('data-url');
    var return_url = $(this).attr('data-return-url');
    
    if(confirm('Are you sure?')){
        $.ajax({
            url: delete_url,
            type: 'DELETE',
            success: function(result){
                window.location = return_url;
            }
        });
    }
});