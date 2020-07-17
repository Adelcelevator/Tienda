<?php
session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: ../Vistas/index.php');
    exit();
}
$id= filter_input(INPUT_GET, 'id');
$nombre= filter_input(INPUT_POST, 'txt_nombre');
$stock= filter_input(INPUT_POST, 'txt_stock');
$stockm= filter_input(INPUT_POST, 'txt_stockm');
$pvp= filter_input(INPUT_POST, 'txt_pvp');
$costo= filter_input(INPUT_POST, 'txt_costo');
$estado= filter_input(INPUT_POST, 'txt_estado');
$tipo= filter_input(INPUT_POST, 'tipo');
include '../Modelo/Productos.php';
$producto = modificarxID($id,$nombre,$stock,$stockm,$pvp,$costo,$estado,$tipo);
if($producto){
    header('Location: ../Vistas/productos.php');
    $_SESSION["mensajeV"] = 'Modificaciones realizadas con exito';
}else{
    header('Location: ../Vistas/productos.php');
    $_SESSION["mensajeV"] = 'Fallo al realizar la transaccion';
}