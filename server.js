const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const fs = require('fs');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

const DB = 'mesajlar.json';

// Mesajları dosyadan yükle (Asla silinmez)
let database = { messages: [] };
if (fs.existsSync(DB)) {
    database = JSON.parse(fs.readFileSync(DB));
}

let activeUsers = {};

app.get('/', (req, res) => res.sendFile(__dirname + '/index.html'));

io.on('connection', (socket) => {
    // Bağlanan kişiye eski mesajları yolla
    socket.emit('old-messages', database.messages);

    socket.on('join', (name) => {
        socket.username = name;
        activeUsers[socket.id] = name;
        io.emit('update-users', Object.values(activeUsers));
    });

    socket.on('chat-msg', (msg) => {
        const data = { 
            user: socket.username, 
            text: msg, 
            time: new Date().toLocaleTimeString('tr-TR', {hour:'2-digit', minute:'2-digit'}) 
        };
        database.messages.push(data);
        fs.writeFileSync(DB, JSON.stringify(database)); // Kaydet
        io.emit('new-msg', data);
    });

    socket.on('disconnect', () => {
        delete activeUsers[socket.id];
        io.emit('update-users', Object.values(activeUsers));
    });
});

server.listen(3000, () => console.log('Sistem 3000 portunda devrede!'));
