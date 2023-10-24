<?php
require_once "./classes/Db.classes.php";
require_once "./classes/Unidad.classes.php";
require_once "./classes/Unidad-view.classes.php";

$unidadView = new UnidadView();
$unidades = $unidadView->fetchAll();
?>
<table id="unidadesReq">
    <thead>
        <tr>
            <th>ID</th>
            <th>Abreviatura</th>
            <th>Nombre</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($unidades as $unidad) {
        ?>
            <tr>
                <td><?= $unidad['ID'] ?></td>
                <td><?= $unidad['Nomenclatura'] ?></td>
                <td><?= $unidad['Nombre'] ?></td>
                <td><a href="./unidadEjecutora.php?id=<?= $unidad['ID'] ?>">Ver</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>