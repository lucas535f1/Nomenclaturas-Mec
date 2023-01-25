<?php
require_once "../classes/Db.classes.php";
require_once "../classes/Unidad.classes.php";
require_once "../classes/Unidad-view.classes.php";

$unidadView = new UnidadView();
$unidades = $unidadView->fetchAll();
?>
<table>
    <tr>
        <th>ID</th>
        <th>Abreviatura</th>
        <th>Nombre</th>
    </tr>
    <?php
    foreach ($unidades as $unidad) {
    ?>
        <tr>
            <td><?= $unidad['ID'] ?></td>
            <td><?= $unidad['Nomenclatura'] ?></td>
            <td><?= $unidad['Nombre'] ?></td>
        </tr>
    <?php } ?>
</table>