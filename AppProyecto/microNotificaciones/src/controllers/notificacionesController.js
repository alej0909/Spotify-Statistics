const express = require('express');
const router = express.Router();
const axios = require('axios');
const notificacionesModel = require('../models/notificacionesModel');

//Obtener notificaciones de usuario
router.get('/notificaciones/:usuario', async (req, res) => {
    const usuario = req.params.usuario;
    var result;
    result = await notificacionesModel.traerNotificacionesUsuario(usuario);
    res.json(result);
});

//Obtener notificaciones de artista
router.get('/notificaciones/artista/:artista', async (req, res) => {
    const artista = req.params.artista;
    result = await notificacionesModel.traerNotificaciones(artista);
    res.json(result);

});


router.get('/notificaciones/:id', async (req, res) => {
    const id = req.params.id;
    var result;
    result = await notificacionesModel.traerNotificacion(id);
    res.json(result[0]);
});

//Crear una opinión
router.post('/notificaciones/:usuario', async (req, res) => {
    const usuario = req.params.usuario;
    const cancion = req.body.cancion;
    const artista = req.body.artista;
    const calificacion = req.body.calificacion;
    const opinion = req.body.opinion;

    console.log(usuario, cancion, artista, calificacion, opinion)
    await actualizarEstadistica(cancion, calificacion)
    var result = await notificacionesModel.crearNotificacion(usuario, cancion, artista, calificacion, opinion);

    res.send("Opinion creada");
    
});

async function actualizarEstadistica(can, calif) {

        await axios.put(`http://localhost:3004/estadisticas/`, {
            cancion: can,
            calificacion: calif
        });
    
}

module.exports = router;
