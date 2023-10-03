const mysql = require('mysql2/promise');
const axios = require('axios');
const connection = mysql.createPool({
host: 'localhost',
user: 'root',
password: '',
database: 'proyecto'
});

//Traer canciones en general
async function traerCanciones() {
const result = await connection.query('SELECT * FROM canciones');
return result[0];
}

//Traer canción por ID
async function traerCancion(id) {
const result = await connection.query('SELECT * FROM canciones WHERE id = ? ', id);
return result[0];
}

//Traer canción por artista
async function traerCancionArtista(artist) {
const result = await connection.query('SELECT * FROM canciones WHERE artist = ? ', artist);
return result;
}

//Traer canción por título
async function traerCancionTitulo(title) {
    const result = await connection.query('SELECT * FROM canciones WHERE title = ? ', title);
    return result[0];
}
async function traerCanciongenero(genero) {
    const result = await connection.query('SELECT title, artist, top_genre,year  FROM canciones WHERE top_genre = ? ', genero);
    return result;
}
    
    

async function actualizarCancion(id, estado) {
const result = await connection.query('UPDATE canciones SET estado = ? WHERE id = ?', [estado, id]);
return result;
}

async function borrarCancion(cancion) {
    const result = await connection.query('DELETE from canciones WHERE title = ?',  cancion);
    return result;
    }


async function crearCancion(usuario, title, artist, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity) {
    console.log("hola mundo")

        const result = await connection.query('INSERT INTO canciones VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [title, artist, top_genre, year, bpm, energy, danceability, dB, liveness, valence, duration, acousticness, speechiness, popularity]);
        return result;

    }



module.exports = {
traerCanciones, traerCancion, actualizarCancion, crearCancion,borrarCancion, traerCancionArtista, traerCancionTitulo, traerCanciongenero
};

