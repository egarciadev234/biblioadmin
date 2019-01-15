<?php
    
    require_once("../users/crud_users.php");
    $nuevo_usuario = new Usuario();
    if ($_POST["inputPassword"] === $_POST["inputVerifyPassword"]) 
    {
        $array_data = [$_POST["inputNombre"], $_POST["inputTelefono"], $_POST["inputEmail"], 
        $_POST["inputPassword"]];
        $nuevo_usuario->agregarUsuario($array_data);
    }
    else
    {
        echo "<script type='text/javascript'>
            alert('Tus contraseñas no coiciden INTENTALO NUEVAMENTEs!!!');
            window.location='../templates/registrar_usuario.php';
            </script>";
    }
    
    
?>