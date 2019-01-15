<?php
    /* 
        Este documento son las consultas referentes a la tabla USUARIOS de 
        la base de datos, mediante el cual se pueden agregar, modificar usuarios
    */

    class Usuario
    {
        public function listarUsuarios()
        {
            include("../connection/database.php");
            require_once("../auth/auth.php");
            $auth = new Auth();
            if (!$auth->userIsAuth())
            {
                header('Location: ../templates/login.php'); 
            }
            else
            {
                require_once("../users/crud_users.php");
                $nuevo_usuario = new Usuario();
                $rol_usuario = $nuevo_usuario->verRolUsuario($_SESSION['user']);
                if($rol_usuario == 0)
                {
                    header('Location: ../templates/mis_prestamos.php'); 
                }
            }
            $consulta = "SELECT * FROM USUARIOS";
            $query_usuarios = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            return $query_usuarios;
        }

        public function verRolUsuario($email)
        {
            include("../connection/database.php");
            require_once("../auth/auth.php");
            $auth = new Auth();
            if (!$auth->userIsAuth())
            {
                header('Location: ../templates/login.php'); 
            }
            $rol = 0;
            $consulta = "SELECT * FROM USUARIOS WHERE EMAIL = '$email';";
            $query_usuario = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            $usuario = mysqli_fetch_object($query_usuario);
            foreach ($usuario as $key=>$value) {
                if($key == "ROL")
                {
                    $rol = $value;
                }
            }
            return $rol;
        }

        public function verEmailUsuario($email)
        {
            include("../connection/database.php");
            require_once("../auth/auth.php");
            $auth = new Auth();
            if (!$auth->userIsAuth())
            {
                header('Location: ../templates/login.php'); 
            }
            $consulta = "SELECT * FROM USUARIOS WHERE ID = '$email';";
            $query_usuario = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            $usuario = mysqli_fetch_object($query_usuario);
            foreach ($usuario as $key=>$value) 
            {
                if($key == "EMAIL")
                {
                    $email = $value;
                }
            }
            return $email;
        }

        public function agregarUsuario($nuevo_usuario)
        {
            include("../connection/database.php");
            $passhash = password_hash($nuevo_usuario[3], PASSWORD_BCRYPT);

            $consulta_libros = "INSERT USUARIOS VALUES(null, '$nuevo_usuario[0]', '$nuevo_usuario[1]', '$nuevo_usuario[2]',
            '$passhash', 0);";
            $query_nuevo_usuario = mysqli_query($conexion, $consulta_libros) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            echo "<script type='text/javascript'>
            alert('Nuevo usuario registrado Exitosamente!!!');
            window.location='../templates/principal.php';
            </script>";
        }
    }
?>