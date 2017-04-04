const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io').listen(http);

// use the static middleware to serve up
// static content
// now localhost:3000/images/kitty.jpg
// will cause the server to search public
// folder to find the file.
// can set multiple static folder
// server searches in top to bottom order
app.use(express.static('public'))

http.listen(3000, function() {
  console.log('listening on 3000')
});

const viewsFolder = __dirname + '/views/';

app.get('/', (req, res) => {
	res.sendFile(viewsFolder + 'index.html');
});

//socket.io stuff
io.on('connection', (socket) => {
	console.log('a user connected');

	socket.on('change room', (data) => {
		console.log(data.room);
		socket.join(data.room);
	});

	socket.on('chat message', (data) => {
		console.log(data.msg);
		socket.to([data.sender, data.receiver].sort().join('')).broadcast.emit('chat message', data);
	});

	socket.on('disconnect', () => {
		console.log('a user disconnected');
	});
});