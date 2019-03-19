var io = require('socket.io')(6001);

io.on('connection',function (socket) {
    console.log('New Connection:',socket.id);

    //socket.send('message from server');

    //socket.emit('server-info',{version:1});

    //socket.broadcast.send('New User');
    
    socket.on('message',function (data) {
        socket.broadcast.send(data.message,data.name);
    })


    

});
