const { Router } = require('express');
const express = require('express');
const axios = require('axios');
const router = Router();
const usuariosModel = require('../models/usuariosModel');

router.get('/usuarios', async (req, res) => {
var result;
result = await usuariosModel.traerUsuarios() ;
res.json(result);
});

router.post('/usuarios/', async (req, res) => {

    const nombre =req.body.nombre;
    const usuario = req.body.usuario;
    const password = req.body.password;
    const rol = req.body.rol;

    var result;
    result = await usuariosModel.crearUsuario(nombre,usuario,password,rol) ;
    res.json(result);
    });
    


router.get('/usuarios/:usuario', async (req, res) => {
    const usuario = req.params.usuario;
var result;
result = await usuariosModel.traerUsuario(usuario) ;
res.json(result[0]);
});

router.get('/usuarios/:usuario/:password', async (req, res) => {
const usuario = req.params.usuario;
const password = req.params.password;
var result;
result = await usuariosModel.validarUsuario(usuario, password) ;
res.json(result);
});

// Ruta para validar usuario artista
router.get('/usuarios/artista/:usuario/:password', async (req, res) => {
    const usuario = req.params.usuario;
    const password = req.params.password;
    var result;
    result = await usuariosModel.validarUsuarioArtista(usuario, password);
    res.json(result);
  });



module.exports = router;