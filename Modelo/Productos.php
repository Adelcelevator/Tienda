<?php
require_once 'Conexion.php';

function todosProductos(){
    $resultado = Conexion()->query("SELECT pro.*, cat.cat_descripcion FROM tbl_producto pro,tbl_categoria cat where pro.pro_id=pro.pro_id and pro.cat_id = cat.cat_id and cat.cat_id=cat.cat_id order by pro.pro_id")->fetch_all();
    return $resultado;
}

function productoXId($id){
    $resultado2 = Conexion()->query("SELECT pro.*, cat.cat_descripcion FROM tbl_producto pro,tbl_categoria cat where pro.pro_id=pro.pro_id and pro.cat_id = cat.cat_id and cat.cat_id=cat.cat_id and pro.pro_id=$id")->fetch_all();
    return $resultado2;
}

