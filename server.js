const app = require('express')();
var cors = require('cors')
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
    cors: {
        origin: "http://localhost:3030",
    },
});
// Listen for new connections
io.on('connection', (socket) => {
    console.log('User connected');

    // Listen for incoming messages
    socket.on('chat-message', (msg) => {
        console.log('Received message:', msg);

        // Broadcast the message to all connected clients
        io.emit('chat-message', msg);
    });

    // Listen for disconnections
    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

// Start the server
http.listen(8080, () => {
    console.log('Listening on *:3030');
});