const express = require('express');
const { createServer } = require('node:http');
const { Server } = require('socket.io');

const app = express();
const server = createServer(app);

// Configuración de CORS y Socket.IO
const io = new Server(server, {
  cors: {
    origin: 'http://localhost:3000',  // Ajusta según el frontend
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type', 'Authorization'],
    credentials: true
  },
  transports: ['websocket', 'polling']  // Los dos transportes más comunes
});

// Almacén de conexiones activas (puedes añadir más información aquí)
const activeConnections = new Map();

io.on('connection', (socket) => {
  console.log('Usuario conectado:', socket.id);

  // Registro del rol de un usuario
  socket.on('register_role', (role) => {
    activeConnections.set(socket.id, { role });
    console.log(`Rol registrado: ${role} (${socket.id})`);
  });

  // Notificación de profesor a alumnos
  socket.on('notificacion', (data) => {
    const connection = activeConnections.get(socket.id);
    
    // Solo el profesor puede emitir notificaciones
    if (connection?.role === 'profesor') {
      activeConnections.forEach((value, key) => {
        if (value.role === 'alumno') {
          io.to(key).emit('nueva-notificacion', {
            ...data,
            timestamp: new Date().toISOString()
          });
        }
      });
      console.log('Notificación enviada a alumnos');
    }
  });

  // Manejo de desconexión
  socket.on('disconnect', () => {
    activeConnections.delete(socket.id);
    console.log('Usuario desconectado:', socket.id);
  });
});

// Iniciar servidor
server.listen(5000, () => {
  console.log('🚀 Servidor Socket.IO escuchando en puerto 5000');
});
