<?php
require_once "../classes/Db.classes.php";
require_once "../classes/Oficina.classes.php";
require_once "../classes/Oficina-view.classes.php";

$oficinasView = new OficinaView();
$oficinas = $oficinasView->fetchAll();
?>
<table id="oficinasTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>UE</th>
            <th>Abreviatura</th>
            <th>Nombre</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($oficinas as $oficina) {
        ?>
            <tr>
                <td><?= $oficina['ID'] ?></td>
                <td><?= $oficina['IdUE'] ?></td>
                <td><?= $oficina['Nomenclatura'] ?></td>
                <td><?= $oficina['Nombre'] ?></td>
                <td><a href="./area.php?id=<?= $oficina['ID'] ?>">Ver</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>