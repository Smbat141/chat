var io = require('socket.io')(6001);
var userCount = 0;

io.on('connection',function (socket) {
    console.log('New Connection:',socket.id);

    userCount++;
    io.sockets.emit('userCount', { userCount: userCount + ' ' + 'online' });

    socket.on('disconnect', function() {
        userCount--;
        io.sockets.emit('userCount', { userCount: userCount + ' ' + 'online'});
    });


    //socket.send('message from server');

    //socket.emit('server-info',{version:1});

    //socket.broadcast.send('New User');
    
    socket.on('message',function (data) {
        socket.broadcast.send({name : data.name,message : data.message});
    })


});

