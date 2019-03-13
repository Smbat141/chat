$(document).ready(function ($) {
    $('#comment').on('click','#submit',function (event) {
        event.preventDefault();

        var data = $('#comment').serializeArray();

        $.ajax({
            url:$('#comment').attr('action'),
            data:data,
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            dataType:'JSON',
            success:function () {
                console.log('success');

            },
            
            error:function () {
                console.log('error');
            }
        })
    })


    $('.get_room').on('click',function(){
        var html = $(this).find('div span').html();
        var url = $(this).find('.url').val();
        var room_user_id = $(this).find('.rooom_user_id').val();
        var user_id = $(this).find('.user_id').val();


        if(html === ' Private' && room_user_id !== user_id ){
           var name =  prompt('Please enter your url',);
           if(name == url){
               alert('success');
               return true;
           }
           else{
               alert('error');
                return false
           }

        }



    });


});
