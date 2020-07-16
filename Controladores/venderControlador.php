<?php

session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: ../Vistas/index.php');
    exit();
}
$id = filter_input(INPUT_GET, 'idPro');
if ($id == null) {
    header('Location: ../Vistas/productos.php');
    exit();
}
$precio = filter_input(INPUT_GET, 'precioV');
if ($precio == null) {
    header('Location: ../Vistas/productos.php');
    exit();
}
$stock = filter_input(INPUT_GET, 'stockP');
if ($precio == null) {
    header('Location: ../Vistas/productos.php');
    exit();
}

$cantidad = filter_input(INPUT_POST, 'txt_cantidad');
echo 'ID: ' . $id . '<br/>';
echo 'CANTIDAD: ' . $cantidad . '<br/>';
echo 'USUARIO: ' . $usuario . '<br/>';
echo 'PRECIO: ' . $precio . '<br/>';

include '../Modelo/Venta.php';
include '../Modelo/Productos.php';
include '../Modelo/Caja.php';
$venta = vender($cantidad, $precio, $id);
if ($venta) {
    $actualizar = salidaxID($id, $cantidad, $stock);
    if ($actualizar) {
        $precioso= $cantidad*$precio;
        $caja = actualizarCaja($precioso, $_SESSION['id_caja']);
        if($caja){
        $_SESSION["mensajeV"] = 'Transaccion realizada con exito';
        header('Location: ../Vistas/productos.php');
        exit();    
        }else{
        $_SESSION["mensajeV"] = 'Fallamos al actualizar la caja';
        header('Location: ../Vistas/productos.php');
        exit();    
        }
    } else {
        $_SESSION["mensajeV"] = 'Fallamos al actualizar el stock';
        header('Location: ../Vistas/productos.php');
        exit();
    }
} else {
    $_SESSION["mensajeV"] = 'No se pudo realizar la venta';
    header('Location: ../Vistas/productos.php');
    exit();
}
