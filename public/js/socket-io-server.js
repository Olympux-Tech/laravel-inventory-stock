var express = require('express')();
var server = require('http').Server(express);
var io = require('socket.io')(server);

io.on('connection', function (socket) {

    console.log("new client connected");

    socket.on('chat-message', function (data) {

        var res = data;

        console.log('chat-message', JSON.stringify(res));

        io.emit('chat-message', res);

    });

    socket.on('joinChat', (data) => { // send message private chat

        var res = data;

        console.log('joinChat', 'sending '+JSON.stringify(res));
        
        socket.join(data.id);
        
    });    

    socket.on('sendMsg', (data) => { // send message private chat

        var res = data;

        console.log('sendMsg', 'sending '+JSON.stringify(res));
        
        // socket.to(data.id).emit('receiveMsg', data);
        io.to(data.id).emit('receiveMsg', data);
        
    });

    socket.on('user-join', function(data) {

        var res = data;

        console.log('user-join', res);

        io.emit('user-join', res);
    });

    socket.on('disconnect', function(data) {

        var res = data;

        console.log('disconnect');

        io.emit('user-unjoin', res);
    });


});

server.listen(9090, function () {

    console.log('socket.io server listen at 9090');

});