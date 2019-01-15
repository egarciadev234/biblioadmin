<?php
    require_once("../books/crud_books.php");
    $ver_libro = new Libro();
    $id = $_GET["id"];
    $operation = $_GET["ope"];

    if ($operation == 'update') 
    {
        $ver_libro->modificarLibro($id);
    }
    else
    {
        $ver_libro->deshabilitarLibro($id);
    }
?>