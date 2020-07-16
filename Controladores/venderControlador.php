<?php
session_start();
$usuario = filter_input(INPUT_POST, 'txt_usuario');
$contra = filter_input(INPUT_POST, 'txt_contra');
if (!trim($usuario) == null) {
    if (!trim($contra) == null) {
        include '../Modelo/Usuario.php';
        $peticion = usuarioxusuario($usuario);
        $resultado = $peticion->fetch_all();
        foreach ($resultado as $res) {
            $usubd = $res[3];
            $contradb = $res[4];
            $tipo = $res[5];
        }
    }
}
