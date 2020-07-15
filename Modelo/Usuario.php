<?php
require_once 'Conexion.php';
function usuarioxusuario($usuario){
    $peti = "select * from tbl_usuario where us_user='$usuario' and us_id=us_id";
   $resultado = Conexion()->query($peti);
   return $resultado;
}

