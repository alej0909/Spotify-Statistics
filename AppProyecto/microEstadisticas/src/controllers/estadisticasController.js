const { Router } = require('express');
const router = Router();
const axios = require('axios');
const estadisticasModel = require('../models/estadisticasModel');

//Obtener estadisticas por cancion
router.get('/estadisticas/top', async (req, res) => {
    console.log("este es otro")
    var result;
    result = await estadisticasModel.traerTop();
    console.log(result)
    res.json(result);
});
router.get('/estadisticas/:cancion', async (req, res) => {
    const cancion = req.params.cancion;
    var result;
    result = await estadisticasModel.traerCancion(cancion);
    res.json(result);
});

router.put('/estadisticas/', async (req, res) => {
    const cancion = req.body.cancion;
    const calificacion = parseFloat(req.body.calificacion);
    var result = await estadisticasModel.actualizarEstadistica(cancion, calificacion);
    res.send("inventario de producto actualizado");
});


//Crear una canción (sólo artistas)
router.post('/estadisticas/:usuario', async (req, res) => {
    const usuario = req.params.usuario;
    const title = req.body.title;
    const top_genre = req.body.top_genre;
    const year = req.body.year;
    const bpm = req.body.bpm;
    const energy = req.body.energy;
    const danceability = req.body.danceability;
    const dB = req.body.dB;
    const liveness = req.body.liveness;
    const valence = req.body.valence;
    const duration = req.body.duration;
    const acousticness = req.body.acousticness;
    const speechiness = req.body.speechiness;
    const popularity = req.body.popularity;
    console.log(usuario,title, top_genre,year,bpm,energy,danceability,dB,liveness,valence,duration,acousticness,speechiness, popularity )
    try{
        const result = await estadisticasModel.crearCancion(usuario, title, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity); // Reemplaza con la función adecuada para obtener notificaciones
        console.log(result)
        res.send("Canción creada");
    } catch (error) {
        res.status(500).json({ mensaje: 'Acceso denegado' });
      }
    

    router.delete('/estadisticas/:cancion', async (req, res) => {
        const cancion= req.params.cancion;
        var result = await estadisticasModel.borrarCancion(cancion);
        res.send("Lista de canciones actualizada");
    });
});
module.exports = router;