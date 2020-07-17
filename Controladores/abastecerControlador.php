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
$stock = filter_input(INPUT_GET, 'stockn');
if ($stock == null) {
    header('Location: ../Vistas/productos.php');
    exit();
}

$cantidad = filter_input(INPUT_POST, 'txt_cantidad');


include '../Modelo/Productos.php';
$entrada = entradaxID($id, $cantidad, $stock);
if ($entrada) {
    include '../Modelo/Caja.php';
    $costo = filter_input(INPUT_POST, 'txt_precio');
    $costoso = $costo * $cantidad;
    $caja = salidaCaja($costoso, $_SESSION['id_caja']);
    if ($caja) {
        $_SESSION["mensajeV"] = 'Transaccion realizada con exito';
        header('Location: ../Vistas/productos.php');
        exit();
    } else {
        $_SESSION["mensajeV"] = 'No se pudo realizar la compra';
        header('Location: ../Vistas/productos.php');
        exit();
    }
}