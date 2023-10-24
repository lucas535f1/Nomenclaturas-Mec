<?php
    $serie=$_POST['serie'];
    $telefono=$_POST['telefono'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $usuario=$_POST['usuario'];
    $modelo=$_POST['modelo'];
    $observaciones=$_POST['observaciones'];
    $idInventario=$_POST['idInventario'];
    $so=$_POST['so'];
    $oficina=$_POST['oficina'];
    $tipoEquipo=$_POST['tipoEquipo'];
    $nombreEquipo=$_POST['equipo'];
    
    require "../classes/Db.classes.php";
    require "../classes/Equipo.classes.php";
    require "../classes/Equipo-contr.classes.php";

    $equipo = new EquipoContr($serie, $telefono, $nombre, $apellido, $usuario, $modelo, $observaciones, $idInventario, $so, $oficina, $tipoEquipo, $nombreEquipo);
    $equipo->createEquipo();

    $msg="Equipo registrado correctamente";
    echo json_encode($msg);
