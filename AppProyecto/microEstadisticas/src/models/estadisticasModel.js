const mysql = require('mysql2/promise');
const axios = require('axios');

const connection = mysql.createPool({
host: 'localhost',
user: 'root',
password: '',
database: 'proyecto'
});

//Traer canción por ID
async function traerCancion(cancion) {
    console.log()
    const result = await connection.query('SELECT * FROM estadisticas WHERE title = ? ', cancion);
    return result[0];
    }
async function actualizarEstadistica(cancion, calificacion) {
        console.log(cancion, calificacion)
        const result1 = await connection.query('SELECT calificacion, cantidadop FROM estadisticas WHERE title = ? ', cancion);
        const calificacionActual = result1[0][0].calificacion
        const opinionesActual= result1[0][0].cantidadop
        console.log(calificacionActual, opinionesActual,calificacion,cancion)
        if (opinionesActual !== 0) {
            calificacionNueva = (calificacionActual + (calificacion / opinionesActual)) / 2;
          } else {
            // Si opinionesActual es cero, simplemente establece calificacionNueva en calificacion
            calificacionNueva = calificacion;
          }
          

        console.log(calificacionNueva)
        opinionesNueva = opinionesActual +1

        const result = await connection.query('UPDATE estadisticas SET calificacion = ?, cantidadop = ? WHERE title = ?', [calificacionNueva, opinionesNueva, cancion]);
        return result;
    } 
    async function crearCancion(usuario, title, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity) {
            var calificacion = 0
            var opiniones = 0
            const result = await connection.query('INSERT INTO estadisticas VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [title, usuario, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity, opiniones,calificacion]);
            return result;

    }

 
    async function traerTop() {
        console.log("hola")
        const result = await connection.query('SELECT title, artist, AVG(calificacion) AS promedio_calificacion FROM estadisticas GROUP BY title, artist ORDER BY promedio_calificacion DESC LIMIT 10');
        return result[0];
    }
    

    async function borrarCancion(cancion) {

        const result = await connection.query('DELETE from canciones WHERE title = ?',  cancion);
        return result;
    }
    
module.exports = {
    traerCancion, actualizarEstadistica,crearCancion, traerTop, borrarCancion
    };
    
    