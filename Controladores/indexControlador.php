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
        if (!trim($usubd)==null) {
            if ($contra == $contradb) {
               $_SESSION['usuario']=$usuario;
               $_SESSION['tipo']=$tipo;
               $_SESSION["mensaje"]=null;
                header('Location: ../Vistas/productos.php');
                exit();
            } else {
                $_SESSION['usuario']=null;
                $_SESSION["mensaje"] = 'Contraseña Incorrecta';
                header('Location: ../Vistas/index.php');
                exit();
            }
        } else {
            $_SESSION['usuario']=null;
            $_SESSION["mensaje"] = 'No existe el usuario';
            header('Location: ../Vistas/index.php');
            exit();
        }
    } else {
        $_SESSION['usuario']=null;
        $_SESSION["mensaje"] = 'Campo de Contraseña Vacio';
        header('Location: ../Vistas/index.php');
    }
} else {
    $_SESSION['usuario']=null;
    $_SESSION["mensaje"] = 'Campo de Usuario Vacio';
    header('Location: ../Vistas/index.php');
    exit();
    
}