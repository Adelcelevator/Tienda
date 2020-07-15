<?php

require_once 'Conexion.php';

function dineroenCajaFecha($fecha) {
    $resultado = Conexion()->query("SELECT caja.caja_valorfinal FROM tbl_caja caja WHERE caja_fechainicio='$fecha' and caja.caja_id=caja_id")->fetch_all();
    return $resultado;
}

function dineroenCajaHoy() {
    $fecha = getdate();
    if (strlen($fecha['mon']) == 1) {
        $fecha['mon'] = '0' . $fecha['mon'];
    }
    $dineroad=0;
    $fechafi = $fecha['year'] . '-' . $fecha['mon'] . '-' . $fecha['mday'];
    $resultado = Conexion()->query("SELECT caja.caja_valorfinal FROM tbl_caja caja WHERE caja_fechainicio='$fechafi' and caja.caja_id=caja_id")->fetch_all();
    $fechafin = $fecha['year'] . '-' . $fecha['mon'] . '-' . date('d', strtotime('-1 day'));
    if (sizeof($resultado) == 0) {
        $resultado2 = Conexion()->query("SELECT caja.caja_valorfinal FROM tbl_caja caja WHERE caja_fechainicio='$fechafin' and caja.caja_id=caja_id")->fetch_all();
        foreach ($resultado2 as $res2){        
        $dineroad=$res2[0];
        }
        Conexion()->query("INSERT INTO tbl_caja values (null,'$fechafi','$fechafi',$dineroad,$dineroad,$dineroad)");
    }
    $resultado2 = Conexion()->query("SELECT caja.caja_valorfinal FROM tbl_caja caja WHERE caja_fechainicio='$fechafin' and caja.caja_id=caja_id")->fetch_all();
    return $resultado2;
}
