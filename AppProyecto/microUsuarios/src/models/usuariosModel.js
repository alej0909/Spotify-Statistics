const mysql = require('mysql2/promise');
const connection = mysql.createPool({
host: 'localhost',
user: 'root',
password: '',
database: 'proyecto'
});

async function validarUsuario(usuario, password) {
    const result = await connection.query('SELECT * FROM usuarios WHERE usuario = ? AND password = ?', [usuario, password]);
    return result[0];
}

async function validarUsuarioArtista(usuario, password) {
    const result = await connection.query('SELECT * FROM usuarios WHERE usuario = ? AND password = ? and rol = "artista"', [usuario, password]);
    return result[0];
}
  
async function traerUsuarios() {
const result = await connection.query('SELECT * FROM usuarios');
return result[0];
}
async function traerUsuario(usuario) {
const result = await connection.query('SELECT * FROM usuarios WHERE usuario = ?', usuario);
return result[0];
}


async function crearUsuario(nombre, usuario, password, rol) {
const result = await connection.query('INSERT INTO usuarios VALUES(null,?,?,?,?)', [nombre, usuario, password, rol]);
return result;
}

async function verificarRol(user) {
    var result = await connection.query('SELECT rol FROM usuarios where usuario = ?', user );
    result =result[0][0].rol;
    console.log(result)
    return result;
    }


    module.exports = {
        traerUsuarios, traerUsuario, validarUsuario, crearUsuario,verificarRol, validarUsuarioArtista
        };