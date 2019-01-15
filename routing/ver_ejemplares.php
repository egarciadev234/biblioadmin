<?php
    require_once("../books/crud_books.php");
    $ver_ejemplares = new Libro();
    $id = $_GET["id"];
    $ver_ejemplares->listarEjemplares($id);
?>