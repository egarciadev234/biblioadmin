<?php
    require_once("../auth/auth.php");
    $auth = new Auth();

    if ($auth->userIsAuth()) 
    {
        echo "<script type='text/javascript'>
        alert('Deseas irte !!!');
        </script>";
        $auth->logout();
    } 
    else if ($_POST)
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) ) 
        {
            $email = $_POST['email'];
            $passwd = $_POST['password'];
        
            if ($auth->login($email, $passwd)) 
            {
                require_once("../users/crud_users.php");
                $usuario = new Usuario();

                $datos = $usuario->listarUsuarios();
                while($dato = mysqli_fetch_array($datos))
                {
                    if($dato["ROL"] == 1)
                    {
                        echo "<script type='text/javascript'>
                        alert('Has ingresado Exitosamente!!!');
                        window.location='../templates/index.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'>
                        alert('Has ingresado Exitosamente!!!');
                        window.location='../templates/mis_prestamos.php?rol=$dato[ROL]';
                        </script>";
                    }
                }

               
            } 
            else 
            {
                echo "<script type='text/javascript'>
                alert('Las credenciales ingresadas no se lograron validar INTENTALO NUEVAMENTE!!!');
                window.location='../templates/login.php';
                </script>";
            }
        } 
        else 
        {
            echo "<script type='text/javascript'>
            alert('Tienes que ingresar todos los campos INTENTALO NUEVAMENTE!!!');
            window.location='../templates/login.php';
            </script>";
        }
    }
?>