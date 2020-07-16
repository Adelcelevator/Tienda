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
foreach ($productos as $pro) {
    $id = $pro[0];
    $producto = $pro[1];
    $precio = $pro[4];
    $tipo = $pro[8];
    $stock = $pro[2];
    echo 'Se va a vender el producto: ' . $pro[1];
}
echo '<form action="../Controladores/venderControlador.php?idPro=' . $id . '&precioV='.$precio. '&stockP='.$stock.'" method="POST">';
?>
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
            <td class="tablaedit2" colspan="2">Cuantas Unidades se van a vender: <input type="text" id="txt_cantidad" onkeyup="validarCant()" name="txt_cantidad"></td>
        </tr>
        <tr>
            <td colspan="3"><center><input onclick="cobrar()" onmouseover="validarCat()" onfocus="validarCat()" class="btn btn-outline-warning" id="btn_vender" type="submit" value="Vender"/>&nbsp;&nbsp;<a class="btn btn-success" href="productos.php">Cancelar</a></center></td>
</tr>
</tbody>
</table>
</form>
<script type="text/javascript">
    function validarCat(){
        if (document.getElementById("txt_cantidad").value =="") {
            alert("Campo cantidad Vacio");
            document.getElementById("btn_vender").disabled = true;
        }
    }
    function validarCant() {
        if (document.getElementById("txt_cantidad").value > <?php echo $stock; ?>) {
            alert("La cantidad a vender supera a la cantidad en bodega");
            document.getElementById("btn_vender").disabled = true;
        } else {
            document.getElementById("btn_vender").disabled = false;
        }
    }
    function cobrar(){
        alert("El valor a Cobrar es de: $"+(parseFloat(<?php echo $precio;?>)*parseFloat(document.getElementById("txt_cantidad").value)));
    }
</script>
<?php
include './template/FooterAdmin.php';
exit();
?>