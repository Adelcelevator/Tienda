<?php
session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == null) {
    header('Location: index.php');
    exit();
}
include './template/HederAdmin.php';
include '../Modelo/Productos.php';
$id = filter_input(INPUT_GET, "id");
$productos = productoXId($id);
foreach ($productos as $pro) {
    $id = $pro[0];
    $producto = $pro[1];
    $stock = $pro[2];
    $stockm = $pro[3];
    $pvp = $pro[4];
    $costo = $pro[5];
    $estado = $pro[6];
    $tipo = $pro[8];
    echo 'Se va a editar el producto: ' . $pro[1];
}
echo '<form action="../Controladores/editarControlador.php?id='.$id.'" method="POST">';
?>

    <table border="1">
        <tbody>
            <tr>
                <td class="tablaedit">Producto:</td>
                <td class="tablaedit2"><?php echo $producto; ?></td>
                <td class="tablaedit">Nuevo Nombre:</td>
                <td> <input type="text" name="txt_nombre" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">Stock:</td>
                <td class="tablaedit2"><?php echo $stock; ?></td>
                <td class="tablaedit">Nuevo Stock:</td>
                <td> <input type="text" name="txt_stock" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">Stock Minimo:</td>
                <td class="tablaedit2"><?php echo $stockm; ?></td>
                <td class="tablaedit">Nuevo Stock Minimo:</td>
                <td> <input type="text" name="txt_stockm" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">PVP:</td>
                <td class="tablaedit2"><?php echo $pvp; ?></td>
                <td class="tablaedit">Nuevo PVP:</td>
                <td> <input type="text" name="txt_pvp" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">Costo:</td>
                <td class="tablaedit2"><?php echo $costo; ?></td>
                <td class="tablaedit">Nuevo Costo:</td>
                <td> <input type="text" name="txt_costo" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">Estado:</td>
                <td class="tablaedit2"><?php echo $estado; ?></td>
                <td class="tablaedit">Nuevo Estado:</td>
                <td> <input type="text" name="txt_estado" required="true"/></td>
            </tr>
            <tr>
                <td class="tablaedit">Tipo:</td>
                <td class="tablaedit2"><?php echo $tipo; ?></td>
                <td>Nuevo Tipo de Producto:</td>
                <td class="tablaedit2"> 
                    <select name="tipo">
                        <option value="esco">Escoja una opcion</option>
                        <?php
                        include '../Modelo/TiposPro.php';
                        $tiposPro = todosTiposPro();
                        foreach ($tiposPro as $tp) {
                            echo '<option value="' . $tp[0] . '">' . $tp[1] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4"><center><input class="btn btn-outline-warning" id="btn_editar" type="submit" value="Editar"/>&nbsp;&nbsp;<a class="btn btn-success" href="productos.php">Cancelar</a></center></td>
        </tr>
        </tbody>
    </table>

</form>
<?php
include './template/FooterAdmin.php';
?>

