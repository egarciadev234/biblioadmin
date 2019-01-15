<?php
    /*
        Este documento permite autenticar un usuario registrado en la base de datos
    */

    class Auth 
    {
        function userIsAuth()
        {
        
            if ( !isset($_SESSION) ){
                session_start();
            }
        
            if ( isset($_SESSION['user']) )
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 

        public function login($email, $passwd)
        {
            include("../connection/database.php");
            if ( !isset($_SESSION) )
            {
                session_start();
            }
            $hashpass = '';
            $rol_user = 0;
            $consulta = "SELECT * FROM USUARIOS where EMAIL='$email';";
            $query_login = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            $datos_login = mysqli_fetch_object($query_login);
            foreach ($datos_login as $key=>$value) {

                if($key == 'ROL')
                {
                    $rol_user = $value;
                }

                if($key == "PASSWORD")
                {
                    $hashpass = $value;
                }
            }
            if (!password_verify($passwd, $hashpass))
            {
                return false;
            }
            else
            {
                $_SESSION['user'] = $email;
                
                return true;
            }
            
        }
        public function logout()
        {
            if ($this->userIsAuth()) {
                if ( !isset($_SESSION) )
                {
                  session_start();
                }
                unset($_SESSION['user']);
                session_destroy();
               
                echo "<script type='text/javascript'>
                alert('Hasta pronto!!!');
                window.location='../templates/login.php';
                </script>";
               
              } else {
                echo "<script type='text/javascript'>
                alert('No tienes sesiones activas!!!');
                window.location='../templates/login.php';
                </script>";
              }
        }
    }
?>