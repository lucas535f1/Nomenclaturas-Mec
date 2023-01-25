<?php
require_once "../classes/Db.classes.php";
require_once "../classes/Unidad.classes.php";
require_once "../classes/Unidad-view.classes.php";

$unidadView = new UnidadView();
$unidades = $unidadView->fetchAll();
?>
<label for="select">Unidad ejecutora</label>
<select name="unidades" id="select">
    <?php
    foreach ($unidades as $unidad) {
    ?>
        <option value="<?= $unidad['id'] ?>"><?= $unidad['nombre'] ?></option>
    <?php } ?>
</select>