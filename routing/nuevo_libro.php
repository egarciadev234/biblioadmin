<?php
    require_once("../books/crud_books.php");
    $nuevo_libro = new Libro();
    $array_data = [$_POST["inputTitulo"], $_POST["inputISBN"], $_POST["inputAutor"], 
    $_POST["inputEditorial"], $_POST["inputPaginas"], $_POST["inputPublicacion"], 
    $_POST["inputEjemplares"]];
    $nuevo_libro->agregarLibro($array_data);
?>