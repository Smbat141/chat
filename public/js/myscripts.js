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
});
