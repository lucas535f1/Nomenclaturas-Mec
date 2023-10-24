<?php
require_once "../classes/Db.classes.php";
require_once "../classes/Unidad.classes.php";
require_once "../classes/Unidad-view.classes.php";

$unidadView = new UnidadView();
$unidades = $unidadView->fetchAll();

foreach ($unidades as $unidad) {
?>
    <option value="<?= $unidad['ID'] ?>"><?= $unidad['ID'] ?>-<?= $unidad['Nombre'] ?></option>
<?php }
?>