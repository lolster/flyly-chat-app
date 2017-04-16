/*
	1. Slight code refining and refactoring
	2. fml
	3. MySQL integration
	4. (very low priority) Change the change room event to a handshake time (on connection)
*/
const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io').listen(http);
const mysql = require('mysql');

// do mysql connection stuff
var con = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'root',
	database: 'flyly'
});

// connect
// con.connect(function(err) {
// 	if(err) {
// 		console.log('error connecting to db');
// 		return;
// 	}
// 	else {
// 		console.log('connected to flyly db');
// 	}
// });

// use the static middleware to serve up
// static content
// now localhost:3000/images/kitty.jpg
// will cause the server to search public
// folder to find the file.
// can set multiple static folder
// server searches in top to bottom order
app.use(express.static('public'));

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
		//TODO update MySQL database to reflect that user is logged in and online
	});

	socket.on('chat message', (data) => {
		//TODO Send data to mysql database as well before sending to user
		
		//get the id of sender and reciever
		//sender id
		var s = -1;
		con.query('SELECT userid FROM users WHERE username = ?', [data.sender], function(error, results, fields) {
			if(error || results.length == 0) {
				console.log(error);
				console.log('[ERROR] Cannot get sender id for value ' + data.sender);
				return;
			}
			s = results[0].userid;
			//recv id
			var r = -1
			con.query('SELECT userid FROM users WHERE username = ?', [data.receiver], function(error, results, fields) {
				if(error || results.length == 0) {
					console.log('[ERROR] Cannot get receiver id for value ' + data.receiver);
					return;
				}
				r = results[0].userid;
				console.log('[INFO] From database: ');
				console.log('[INFO] Sender: ' + data.sender + ' id: ' + s);
				console.log('[INFO] Receiver: ' + data.receiver + ' id: ' + r);

				//insert into message table
				var message = {
					body: data.msg,
					send_id: s,
					rcv_id: r
				};

				con.query('INSERT INTO messages SET ?', message, function(err, res) {
					if(err) {
						console.log('[ERROR] Cannot insert message into database');
						return;
					}
					console.log('[INFO] Inserted, insert id: ' + res.insertId);
					console.log('[INFO] ' + 'Message: ' + data.msg);
					socket.to(data.receiver).broadcast.emit('chat message', data);
					console.log('\n\n');
				});
			});
		});
	});

	socket.on('disconnect', () => {
		console.log('a user disconnected');
	});
});

/*
// old stuff
// technically doesn't work
//socket.io stuff
io.on('connection', (socket) => {
	console.log('a user connected');

	socket.on('change room', (data) => {
		console.log(data.room);
		socket.join(data.room);
		//TODO update MySQL database to reflect that user is logged in and online
	});

	socket.on('chat message', (data) => {
		//TODO Send data to mysql database as well before sending to user
		
		//get the id of sender and reciever
		//sender id
		var s = -1;
		con.query('SELECT userid FROM users WHERE username = ?', [data.sender], function(error, results, fields) {
			if(error || results.length == 0) {
				console.log('[ERROR] Cannot get sender id');
				return;
			}
			s = results[0].userid;
		});
		
		//recv id
		var r = -1
		con.query('SELECT userid FROM users WHERE username = ?', [data.receiver], function(error, results, fields) {
			if(error || results.length == 0) {
				console.log('[ERROR] Cannot get receiver id');
				return;
			}
			r = results[0].userid;
		});

		console.log('[INFO] From database: ');
		console.log('[INFO] Sender: ' + data.sender + ' id: ' + s);
		console.log('[INFO] Receiver: ' + data.receiver + ' id: ' + r);

		//insert into message table
		var message = {
			body: data.msg,
			send_id: s,
			rcv_id: r
		};

		con.query('INSERT INTO messages SET ?', message, function(err, res) {
			if(err) {
				console.log('[ERROR] Cannot insert message into database');
				return;
			}
			console.log('[INFO] Inserted, insert id: ' + res.insertId);
		});

		console.log('[INFO] ' + 'Message: ' + data.msg);
		socket.to(data.receiver).broadcast.emit('chat message', data);
		console.log('\n\n');
	});

	socket.on('disconnect', () => {
		console.log('a user disconnected');
	});
});
*/
