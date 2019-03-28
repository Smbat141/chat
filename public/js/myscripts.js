function message(text){
    $('.chat-result').append(text);
}

$(document).ready(function ($) {
    $('#comment').on('click','#submit',function (event) {
        event.preventDefault();

        var data = $('#comment').serializeArray();

        $.ajax({
            url:$('#comment').attr('action'),
            data:data,
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            dataType:'html',
            success:function () {
                console.log('success');

            },
            
            error:function () {
                console.log('error');
            }
        })
    })

    $(document).on('click','.get_room', function(e) {
        e.preventDefault();
        var html = $(this).find('div span').html();
        console.log(html);
        var url = $(this).find('.url').val();
        var room_user_id = $(this).find('.rooom_user_id').val();
        var user_id = $(this).find('.user_id').val();
        $('.users_count').append(room_user_id);

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



    var socket = io(':6001');
    //socket.connect('http://localhost:8000/room-number/31');
    socket.on('userCount', function (data) {
        $('div .count_users').html(data.userCount);
    });

    function appendMessage(name,message){

        $('.chat').append('<div class="ale rt alert-primary text-center">' +
            '<p>' + name + '</p>' +
            '<p>' + message + '</p><hr/>' +
            '</div>');
    }

    $('#comment').on('click','#submit',function (event) {
        event.preventDefault();
        var message = $('div .comment_val').val();
        var user_name = $('div .user_name').val();

        socket.send({name : user_name,message : message});
        appendMessage(user_name,message);
        return false;
    });

    socket.on('message',function (data) {
        appendMessage(data.name,data.message);
    });



    $('.search').on('click',function (e) {
        var data = '';
        $.each($("input[name='search']:checked"), function(){
            data = ($(this).val());
        });
        $.ajax({
            url:'http://localhost:8000',
            type:"POST",
            data:{status:data},
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //dataType:'html',
            success:function (html) {
                console.log(html);
                $('tbody').html(html);
            },

            error:function () {
                console.log('error');
            }
        })
    })

});
