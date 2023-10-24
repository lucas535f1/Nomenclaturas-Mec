<?php

require_once "../classes/Db.classes.php";
require_once "../classes/Oficina.classes.php";
require_once "../classes/Oficina-view.classes.php";

$oficinaView = new OficinaView();
$oficinas = $oficinaView->fetchUE($_POST['ue']);
foreach ($oficinas as $oficina) {
?>
    <option value="<?= $oficina['Nomenclatura'] ?>" idOficina="<?= $oficina['ID'] ?>"><?= $oficina['Nombre'] ?></option>
<?php } ?>