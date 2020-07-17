<?php
session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: index.php');
    exit();
}
$id = filter_input(INPUT_GET, 'id');
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
echo '<form action="../Controladores/abastecerControlador.php?idPro=' . $id.'&stockn='.$stock.'" method="POST">';
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
                <td class="tablaedit2">Cuantas Unidades se van a comprar: <input type="text" id="txt_cantidad" name="txt_cantidad" required="true"></td>
            </tr>
            <tr>
                <td>Precio de compra:</td>
                <td class="tablaedit2" colspan="2">Cuanto va a costar: <input type="text" id="txt_precio" name="txt_precio" required="true"></td>
            </tr>
            <tr>
                <td colspan="3"><center><input onclick="valorF()" class="btn btn-outline-warning" id="btn_comprar" type="submit" value="Comprar"/>&nbsp;&nbsp;<a class="btn btn-success" href="productos.php">Cancelar</a></center></td>
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    function valorF() {
        var valor1 = parseInt(document.getElementById("txt_cantidad").value);
        var valor2 = parseFloat(document.getElementById("txt_precio").value);
        alert("SE DEBE PAGAR: " + valor1 * valor2);
    }
</script>
<?php
include './template/FooterAdmin.php';
?>