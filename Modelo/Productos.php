<?php

require_once 'Conexion.php';

function todosProductos() {
    $resultado = Conexion()->query("SELECT pro.*, cat.cat_descripcion FROM tbl_producto pro,tbl_categoria cat where pro.pro_id=pro.pro_id and pro.cat_id = cat.cat_id and cat.cat_id=cat.cat_id order by pro.pro_id")->fetch_all();
    return $resultado;
}

function productoXId($id) {
    $resultado2 = Conexion()->query("SELECT pro.*, cat.cat_descripcion FROM tbl_producto pro,tbl_categoria cat where pro.pro_id=pro.pro_id and pro.cat_id = cat.cat_id and cat.cat_id=cat.cat_id and pro.pro_id=$id")->fetch_all();
    return $resultado2;
}

function salidaxID($id, $cantidad, $stock) {
    $final = $stock - $cantidad;
    if (Conexion()->query("UPDATE tbl_producto SET pro_stock=$final WHERE pro_id =$id")) {
        return true;
    } else {
        return false;
    }
}

function modificarxID($id, $nombre, $stock, $stockm, $pvp, $costo, $estado, $tipo) {
    if (Conexion()->query("UPDATE tbl_producto SET pro_nombre='$nombre',pro_stock=$stock,pro_stockminimo=$stockm,pro_pvp=$pvp,pro_costo=$costo,pro_estado='$estado',cat_id=$tipo WHERE pro_id =$id")) {
        return true;
    } else {
        return false;
    }
}

function entradaxID($id, $cantidad, $stock) {
    $final = $stock + $cantidad;
    if (Conexion()->query("UPDATE tbl_producto SET pro_stock=$final WHERE pro_id =$id")) {
        return true;
    } else {
        return false;
    }
}
