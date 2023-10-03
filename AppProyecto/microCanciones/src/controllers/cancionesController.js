const { Router } = require('express');
const router = Router();
const axios = require('axios');
const cancionesModel = require('../models/cancionesModel');

//Obtener canciones en general
router.get('/canciones', async (req, res) => {
    var result;
    result = await cancionesModel.traerCanciones();
    res.json(result);
});

//Obtener canciones por nombre de artista
router.get('/canciones/artista/:artista', async (req, res) => {
    const artist = req.params.artista; //Los espacios son remplazados por %20
    var result;
    result = await cancionesModel.traerCancionArtista(artist);
    //console.log(result);
    res.json(result[0]);
});

//Obtener canción por ID
router.get('/canciones/:id', async (req, res) => {
    const id = req.params.id;
    var result;
    result = await cancionesModel.traerCancion(id);
    //console.log(result);
    res.json(result[0]);
});

//Obtener canción por título
router.get('/canciones/titulo/:title', async (req, res) => {
    const title = req.params.title;
    var result;
    result = await cancionesModel.traerCancionTitulo(title);
    //console.log(result);
    res.json(result[0]);
});

//Obtener canción por genero
router.get('/canciones/genero/:top_genre', async (req, res) => {
    const top_genre	 = req.params.top_genre;
    var result;
    result = await cancionesModel.traerCanciongenero(top_genre);
    console.log(result[0]);
    res.json(result[0]);
});


router.put('/canciones/:id', async (req, res) => {
    const id = req.params.id;
    const estado = req.body.estado;
    var result = await cancionesModel.actualizarCancion(id, estado);
    res.send("inventario de producto actualizado");
});

//Crear una canción (sólo artistas)
router.post('/canciones/:usuario', async (req, res) => {
    const usuario = req.params.usuario;


    const title = req.body.title;
    const artist = usuario
    const top_genre = req.body.genre;
    const year = await obtenerAnioActual()
    const bpm = Math.floor(Math.random() * 100) + 1;
    const energy = Math.floor(Math.random() * 100) + 1;
    const danceability = Math.floor(Math.random() * 100) + 1;
    const dB = Math.floor(Math.random() * 100) + 1;
    const liveness = Math.floor(Math.random() * 100) + 1;
    const valence = Math.floor(Math.random() * 100) + 1;
    const duration = Math.floor(Math.random() * 100) + 1;
    const acousticness = Math.floor(Math.random() * 100) + 1;
    const speechiness = Math.floor(Math.random() * 100) + 1;
    const popularity = Math.floor(Math.random() * 100) + 1;


    await crearEstadistica(title, artist, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity)

        const result = await cancionesModel.crearCancion(usuario, title, artist, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity); // Reemplaza con la función adecuada para obtener notificaciones

        res.send("Canción creada");

    
    
});

//Obtener canción por título
router.post('/usuarios/:usuario/:password', async (req, res) => {
    const usuario = req.params.usuario;
    const password = req.params.password;
    try {
      const nuevaOpinion = await usuariosModel.crearAsignacionRutina(usuario, password);
      res.status(201).json({ mensaje: 'Rutina seleccionada con éxito', asignacion: nuevaAsignacion });
    } catch (error) {
      console.error(error);
      res.status(500).json({ mensaje: 'Error al seleccionar la rutina' });
    }
  });

router.delete('/canciones/:cancion', async (req, res) => {
    const cancion= req.params.cancion;
    var result = await cancionesModel.borrarCancion(cancion);
    res.send("Lista de canciones actualizada");
});

async function crearEstadistica(title, artist,  top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity) {
    data = {
        title,
        artist,
        top_genre,
        year,
        bpm,
        energy,
        danceability,
        dB,
        liveness,
        valence,
        duration,
        acousticness,
        speechiness,
        popularity,  
    }
    const response = await
           axios.post(`http://localhost:3004/estadisticas/${artist}`, data) 


           


    
}
async function obtenerAnioActual() {
    const fecha = new Date();
    const anio = fecha.getFullYear();
    return anio;
  }
module.exports = router;