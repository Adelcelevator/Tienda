<!DOCTYPE html>
<?php
session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: index.php');
    exit();
}
include 'template/HederAdmin.php';
include '../Modelo/Caja.php';
$dinero = dineroenCajaHoy();
echo 'Dinero en Caja: ';
foreach ($dinero as $d) {
    echo '' . $d[0];
    $_SESSION['dinero_caja']=$d[0];
    $_SESSION['id_caja']=$d[1];
}
?>
<br/>
<br/>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Cantidad Disponible</th>
        <th>IVA</th>
        <th>Precio antes de impuestos</th>
        <th>Se Debe Realizar Pedido</th>
        <th>Acciones</th>
    </tr>
    <?php
    include '../Modelo/Productos.php';
    $productos = todosProductos();
    foreach ($productos as $pro) {
        echo '<tr>'; 
            echo '<td>' . $pro[0] . '</td>';
            echo '<td>' . $pro[1] . '</td>';
            echo '<td>' . $pro[2] . '</td>';
            echo '<td>$' . $pro[5]*0.12 . '</td>';
            echo '<td>$' . $pro[4] . '</td>';
            echo '<td>';
            if($pro[2]<=$pro[3]){
                echo 'Si';
            }else{
                echo 'no';
            }
            echo '</td>';
            echo '<td>' .'<a href="vender.php?id=' . $pro[0] . '">Vender</a>' .'&nbsp;&nbsp;<a href="erms_editar.php?id=' . $pro[0] . '">Abastecer</a>' . '&nbsp;&nbsp;<a href="Modelo/erms_eliminarLi.php?id_libro=' . $pro[0] . '">Modificar</a>' . '</td>';
        echo '</tr>';
    }
    ?>
</table>
<?php
if (isset($_SESSION["mensajeV"])) {
    echo '<br/>' . $_SESSION["mensajeV"];
    $_SESSION["mensajeV"] = null;
}
?>
<?php
include 'template/FooterAdmin.php';
exit();
