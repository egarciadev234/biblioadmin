<?php
    require_once("../books/crud_books.php");
    $modificacion_libro = new Libro();
    $id = $_POST["inputID"];
    $array_data = [$_POST["inputTitulo"], $_POST["inputISBN"], $_POST["inputAutor"], 
    $_POST["inputEditorial"], $_POST["inputPaginas"], $_POST["inputPublicacion"]];
    $modificacion_libro->updateLibro($id, $array_data);
?>