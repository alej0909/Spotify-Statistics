const mysql = require('mysql2/promise');
const axios = require('axios');

const connection = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'proyecto'
});

async function crearNotificacion(usuario, cancion, artista, calificacion, opinion) {

 
        const response = await axios.get(`http://localhost:3001/usuarios/${usuario}/`);
        console.log(response)

            const result = await connection.query('INSERT INTO notificaciones VALUES (null, ?, ?, ?, ?, ?, Now())', [usuario, cancion, artista, calificacion, opinion]);
            return result;

          
  }  // 
    
async function traerNotificacion(id) {
    const result = await connection.query('SELECT * FROM notificaciones WHERE id = ?', id);
    return result[0];
}

async function traerNotificaciones(artista) {
    const result = await connection.query('SELECT * FROM notificaciones WHERE artista = ?', artista);
    return result[0];
}  

async function traerNotificacionesUsuario(usuario) {
    const result = await connection.query('SELECT * FROM notificaciones WHERE usuario = ?', usuario);
    return result[0];
}  

module.exports = {
    crearNotificacion,
    traerNotificacion,
    traerNotificaciones,
    traerNotificacionesUsuario,

};