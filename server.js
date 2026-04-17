const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const fs = require('fs');
const path = require('path');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

const PORT = process.env.PORT || 3000;
const DB_FILE = 'database.json';

// Mesajları kalıcı tutmak için dosyadan oku
let messages = [];
if (fs.existsSync(DB_FILE)) {
    try {
        messages = JSON.parse(fs.readFileSync(DB_FILE, 'utf-8'));
    } catch (e) {
        messages = [];
    }
}

// Aktif kullanıcıları takip et
let activeUsers = {};

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

io.on('connection', (socket) => {
    console.log('Yeni bir bağlantı:', socket.id);

    // Yeni giren kullanıcıya geçmiş mesajları gönder
    socket.emit('loadMessages', messages);

    socket.on('join', (username) => {
        socket.username = username;
        activeUsers[socket.id] = username;
        
        // Herkese güncel kullanıcı listesini gönder
        io.emit('updateUserList', Object.values(activeUsers));
        console.log(`${username} katıldı.`);
    });

    socket.on('sendMessage', (text) => {
        if (!socket.username) return;

        const msgData = {
            user: socket.username,
            text: text,
            time: new Date().toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' })
        };

        messages.push(msgData);
        
        // Mesajı dosyaya kaydet (Sıfırlanmaması için)
        fs.writeFileSync(DB_FILE, JSON.stringify(messages, null, 2));

        // Mesajı herkese gönder
        io.emit('newIncomingMessage', msgData);
    });

    socket.on('disconnect', () => {
        if (socket.username) {
            delete activeUsers[socket.id];
            io.emit('updateUserList', Object.values(activeUsers));
        }
    });
});

server.listen(PORT, () => {
    console.log(`Mega Chat ${PORT} portunda hazır!`);
});
