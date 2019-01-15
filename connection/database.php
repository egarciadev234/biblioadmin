<?php
    include("credentials.php");

    $conexion = mysqli_connect($host, $user, "");
    $db = mysqli_select_db($conexion, $database) or die("Upps! ocurrió un error al intentar conectarse...!");
?>