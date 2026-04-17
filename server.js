const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const fs = require('fs');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

// Mesajları dosyadan yükle (Sıfırlanmaması için)
let messages = [];
if (fs.existsSync('messages.json')) {
    messages = JSON.parse(fs.readFileSync('messages.json'));
}

let activeUsers = new Set();

io.on('connection', (socket) => {
    // Yeni giren kullanıcıya eski mesajları gönder
    socket.emit('previousMessages', messages);

    socket.on('join', (username) => {
        socket.username = username;
        activeUsers.add(username);
        io.emit('updateUserList', Array.from(activeUsers));
    });

    socket.on('newMessage', (msg) => {
        const data = { user: socket.username, text: msg, time: new Date().toLocaleTimeString() };
        messages.push(data);
        
        // Dosyaya kaydet (Kalıcı olması için)
        fs.writeFileSync('messages.json', JSON.stringify(messages));
        
        io.emit('message', data);
    });

    socket.on('disconnect', () => {
        activeUsers.delete(socket.username);
        io.emit('updateUserList', Array.from(activeUsers));
    });
});

server.listen(3000, () => console.log('Chat 3000 portunda aktif!'));
