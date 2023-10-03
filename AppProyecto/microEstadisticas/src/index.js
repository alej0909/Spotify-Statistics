const express = require('express');
const estadisticasController = require('./controllers/estadisticasController');
const morgan = require('morgan');
const app = express();
app.use(morgan('dev'));
app.use(express.json());
app.use(estadisticasController);
app.listen(3004, () => {
console.log('Microservicio estadisticas ejecutandose en el puerto 3004');
});
