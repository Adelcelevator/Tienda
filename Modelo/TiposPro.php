<?php
require_once 'Conexion.php';

function todosTiposPro(){
    $todos = Conexion()->query("SELECT cat.* FROM tbl_categoria cat where cat.cat_id=cat.cat_id")->fetch_all();
    return $todos;
}

function tipoProXId($id){
    $tipo = Conexion()->query("SELECT cat.* FROM tbl_categoria cat where cat.cat_id=cat.cat_id and cat.cat_id=$id")->fetch_all();
    return $tipo;
}

