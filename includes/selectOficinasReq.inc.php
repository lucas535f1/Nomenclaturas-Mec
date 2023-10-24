<?php

require_once "./classes/Db.classes.php";
require_once "./classes/Oficina.classes.php";
require_once "./classes/Oficina-view.classes.php";

$oficinaView = new OficinaView();
$oficinas = $oficinaView->fetchUE($equipo['ueID']);
$selected;
foreach ($oficinas as $oficina) {
    if($equipo['oficina']==$oficina['Nombre']){
        $selected="selected";
    } else {
        $selected="";
    }
?>
    <option <?= $selected ?> value="<?= $oficina['Nomenclatura'] ?>" idOficina="<?= $oficina['ID'] ?>"><?= $oficina['Nombre'] ?></option>
<?php } ?>