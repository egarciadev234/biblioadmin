<?php
    require_once("../books/crud_paydays.php");
     
    $data = json_decode($_POST['array']);
    $user = $_GET["user"];
    $fecha_entrega = $_GET["f_e"];
    $fecha_prestamo = $_GET["f_p"];
    $agregar_prestamo = new Prestamo();
    $agregar_prestamo->agregarPrestamo($user, $fecha_entrega, $fecha_prestamo, $data);
?>