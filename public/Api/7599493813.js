const { Client, Location, List, Buttons, LocalAuth } = require('whatsapp-web.js');
// const qrcode = require('qrcode-terminal');
// let fs = require('fs');
const db = require("./db");
const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);

const client = new Client({
    authStrategy: new LocalAuth()
});

client.initialize();

server.listen(3000);
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/public/index.html');
});

client.on('qr', (qr) => {

    io.on('connection', (socket) => {
        io.to(socket.id).emit("event", qr);
    });

});

client.on('authenticated', () => {
    console.log('AUTHENTICATED');
    // ENVIA UM COMANDO PARA INDEX.HTML PARA REMOVER O CANVAS
    io.on('connection', (socket) => {
        io.to(socket.id).emit("ativar", 'auth');
    });
});

client.on('auth_failure', msg => {
    console.error('Falha na Autenticação', msg);
});
client.on('ready', () => {
    console.log('READY');
});

client.on('message', async msg => {

    const userNumberBefore = client.info.wid.user;
    const userNumber = userNumberBefore.slice(2);
    const user = await db.selectNumero(userNumber);
    const user_id = user[0].user_id;
    const numero = msg.from.slice(0, 12);
    const nome = msg._data.notifyName;

    (async () => {
        let setores = await db.selectSetor(user_id);
        if (setores.length == 0) {
            msg.reply(`*Obrigado por testar o ChatZaping.*
*Sistema em fase de desenvolvimento.*
Por Favor, Cadastre o setor, atendente e pergunta, 
para uma melhor experiência.`);
        } else {
        if (msg.body == setores[0].nome) {
            let atendentes = await db.selectAtendentes(setores[0].id);
            let pergunta = await db.selectPergunta(setores[0].id);
            msg.reply(`*Setor: ${setores[0].nome}.*
*Atendente: ${atendentes[0].nome}.*
A pergunta cadastrada foi:
*${pergunta[0].pergunta}*. 
A Resposta não será exibida por estar em construção.
*Obrigado por testar o ChatZaping.*
*Sistema em fase de desenvolvimento.*
Para maiores informações, mande um email para: 
web.genilson@gmail.com,
ou um zap para: 
(75) 9933-9915.
*Genilson Ribeiro, Desenvolvedor Web*.`);
            } 
            else {
                msg.reply(`*Obrigado por testar o ChatZaping.*
*Sistema em fase de desenvolvimento.*
Existe apenas um Setor cadastrado, *${setores[0].nome}*. 
Digite o setor para continuar.`);
            }
        }

    })();

});

client.on('message_create', (msg) => {
    // Fired on all message creations, including your own
    if (msg.fromMe) {
        //
    }
});

client.on('message_revoke_everyone', async (after, before) => {
    // Fired whenever a message is deleted by anyone (including you)
    console.log(after); // message after it was deleted.
    if (before) {
        console.log(before); // message before it was deleted.
    }
});

client.on('message_revoke_me', async (msg) => {
    // Fired whenever a message is only deleted in your own view.
    console.log(msg.body); // message before it was deleted.
});

client.on('message_ack', (msg, ack) => {
    /*
        == ACK VALUES ==
        ACK_ERROR: -1
        ACK_PENDING: 0
        ACK_SERVER: 1
        ACK_DEVICE: 2
        ACK_READ: 3
        ACK_PLAYED: 4
    */

    if (ack == 3) {
        // The message was read
    }
});

client.on('group_join', (notification) => {
    // User has joined or been added to the group.
    console.log('join', notification);
    notification.reply('User joined.');
});

client.on('group_leave', (notification) => {
    // User has left or been kicked from the group.
    console.log('leave', notification);
    notification.reply('User left.');
});

client.on('group_update', (notification) => {
    // Group picture, subject or description has been updated.
    console.log('update', notification);
});

client.on('change_state', state => {
    console.log('CHANGE STATE', state);
});

client.on('disconnected', (reason) => {
    console.log('Client was logged out', reason);
});
