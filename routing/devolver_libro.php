<?php
    require_once("../books/crud_paydays.php");
    require_once("../books/crud_books.php");
    $id_prestamo = $_GET["id"];
    $id_libro = $_GET["libro"];

    $eliminar_prestamo = new Prestamo();
    $eliminar_prestamo->eliminarPrestamo($id_prestamo, $id_libro);
?>