const express = require('express');
const notificacionesController = require('./controllers/notificacionesController');
const morgan = require('morgan');
const app = express();
app.use(morgan('dev'));
app.use(express.json());
app.use(notificacionesController);
app.listen(3003, () => {
console.log('Microservicio de notificaciones escuchando en el puerto 3003');
});