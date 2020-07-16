<?php
require_once 'Conexion.php';

function vender($cantidad,$precio,$idPro){
    $fecha = getdate();
    if (strlen($fecha['mon']) == 1) {
        $fecha['mon'] = '0' . $fecha['mon'];
    }
    $fechafi = $fecha['year'] . '-' . $fecha['mon'] . '-' . $fecha['mday'];
    $precioso= $cantidad*$precio;
            $iva=($precio)*0.12;
            $final=$precioso+$iva;
    if(Conexion()->query("Insert into tbl_detventa values (null,$cantidad,'Venta de hoy: $fechafi',$precio,$precioso,$iva,$final,1,$idPro)")){
        return true;   
    }else{
        return false;
    }
    
}

