const express = require('express');
const cancionesController = require('./controllers/cancionesController');
const morgan = require('morgan');
const app = express();
app.use(morgan('dev'));
app.use(express.json());
app.use(cancionesController);
app.listen(3002, () => {
console.log('Microservicio canciones ejecutandose en el puerto 3002');
});
