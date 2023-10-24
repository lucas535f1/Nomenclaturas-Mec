<?php
require_once "./classes/Db.classes.php";
require_once "./classes/Unidad.classes.php";
require_once "./classes/Unidad-view.classes.php";

$unidadView = new UnidadView();
if ($_SERVER['REQUEST_URI'] == "/nomenclaturas.php" || substr($_SERVER['REQUEST_URI'],0,19)=="/editarArea.php?id=") {
    $unidades = $unidadView->fetchAll();
} else {
    $unidades = $unidadView->fetchAreas();
}

if (substr($_SERVER['REQUEST_URI'], 0, 21) == "/editarEquipo.php?id=") {
    $selected = "";
    foreach ($unidades as $unidad) {
        $value = $unidad['ID'] . "|" . $unidad['Nomenclatura'];
        if ($value == $ue) {
            $selected = "selected";
        } else {
            $selected = "";
        }
?>
        <option <?= $selected ?> value="<?= $value ?>"><?= $unidad['ID'] ?>-<?= $unidad['Nombre'] ?></option>
    <?php }
} else if (substr($_SERVER['REQUEST_URI'], 0, 15) == "/editarArea.php") {
    $selected = "";
    foreach ($unidades as $unidad) {
        $value = $unidad['ID'];
        if ($value == $ue) {
            $selected = "selected";
        } else {
            $selected = "";
        }
    ?>
        <option <?= $selected ?> value="<?= $value ?>"><?= $unidad['ID'] ?>-<?= $unidad['Nombre'] ?></option>
    <?php }
} else if ($_SERVER['REQUEST_URI'] != "/nomenclaturas.php") {
    foreach ($unidades as $unidad) {
        $value = $unidad['ID'] . "|" . $unidad['Nomenclatura'];
    ?>
        <option value="<?= $value ?>"><?= $unidad['ID'] ?>-<?= $unidad['Nombre'] ?></option>
    <?php }
} else {
    foreach ($unidades as $unidad) {
    ?>
        <option value="<?= $unidad['ID'] ?>"><?= $unidad['ID'] ?>-<?= $unidad['Nombre'] ?></option>
<?php }
}
