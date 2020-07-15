<?php
session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: index.php');
    exit();
}
$id = filter_input(INPUT_GET, 'id');
if ($id == null) {
    header('Location: productos.php');
    exit();
}
include './template/HederAdmin.php';
include '../Modelo/Productos.php';
$productos = productoXId($id);
foreach ($productos as $pro){
    $producto = $pro[1];
    $precio=$pro[4];
    $tipo=$pro[8];
    $stock=$pro[2];
    echo 'Se va a vender el producto: '.$pro[1];
}
?>
<form>
    <table border="1" class="tablaedit">
        <tbody>
            <tr>
                <td>Producto:</td>
                <td class="tablaedit2" colspan="2"><?php echo $producto; ?></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td class="tablaedit2" colspan="2"><?php echo $precio; ?></td>
            </tr>
            <tr>
                <td>Tipo:</td>
                <td class="tablaedit2" colspan="2"><?php echo $tipo; ?></td>
            </tr>
            <tr>
                <td>Stock:</td>
                <td class="tablaedit2"><?php echo $stock; ?></td>    
                <td class="tablaedit2" colspan="2">Cuantas Unidades se van a vender: <input type="text" name="anio"></td>
            </tr>
            <tr>
                <td colspan="3"><center><input class="btn btn-outline-warning" type="submit" value="Vender"/>&nbsp;&nbsp;<a class="btn btn-success" href="productos.php">Cancelar</a></center></td>
        </tr>
        </tbody>
    </table>
</form>
<?php
include './template/FooterAdmin.php';
exit();
?>