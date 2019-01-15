<?php
    /* 
        Este documento son las consultas referentes a la tabla PRESTAMOS de 
        la base de datos, mediante el cual se pueden agregar, modificar, eliminar alertar y deshabilitar
        prestamos
    */

    class Prestamo
    {
        public function listarPrestamos()
        {
            include("../connection/database.php");
            $consulta = "SELECT * FROM PRESTAMOS";
            $query_prestamos = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            return $query_prestamos;
        } 

        public function misPrestamos()
        {
            include("../connection/database.php");
            $usuario = $_SESSION["user"];
            $id = 0;
            $consulta_datos = "SELECT * FROM USUARIOS WHERE EMAIL = '$usuario';";
            $query_datos = mysqli_query($conexion, $consulta_datos) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            
            while($prestamo = mysqli_fetch_array($query_datos))
            {
                $id = $prestamo["ID"];
            }
            return $id;
        }

        public function solicitarPrestamo()
        {
            include("../connection/database.php");
            $consulta = "SELECT * FROM LIBROS";
            $query_libros = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            return $query_libros;
        }
        public function agregarPrestamo($usuario, $fecha_entrega, $fecha_prestamo, $datos)
        {
            $id = 0;
            $id_usuario = 0;
            include("../connection/database.php");
            $consulta_usuario = "SELECT * FROM USUARIOS WHERE EMAIL = '$usuario';";
            $query_usuario = mysqli_query($conexion, $consulta_usuario) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            $usuario = mysqli_fetch_object($query_usuario);
            foreach ($usuario as $key=>$value) {
                if($key == "ID")
                {
                    $id_usuario = $value;
                }
            }
            
            foreach ($datos as $k => $v) 
            {
                $id = (int)$v;
                $consulta_nuevo_prestamo = "INSERT INTO PRESTAMOS VALUES(null, '$fecha_prestamo', '$fecha_entrega', ' $id_usuario',
                '$id', 0);";
                $query_nuevo_prestamo = mysqli_query($conexion, $consulta_nuevo_prestamo) or die("Ha fallado la consulta Intentalo mas tarde!!!!");     

                $consulta_libro = "UPDATE LIBROS SET ESTADO_LIBRO=1 WHERE ID='$id';";
                $query_libros = mysqli_query($conexion, $consulta_libro) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            }
            return true;
        }
        public function alertarPrestamo($email)
        {
            
            include("../connection/sendemail.php");
            $mail_username="";//correo que sirve de emisor
            $mail_userpassword="";//contraseña del correo del emisor
            $mail_addAddress=$email;
            $template="../templates/email_template.html";
            
            sendemail($mail_username,$mail_userpassword,$mail_addAddress,$template);
        }
        public function modificarPrestamo($id)
        {
            include("../connection/database.php");
            $consulta = "UPDATE PRESTAMOS SET ESTADO_PRESTAMO= 1 WHERE ID=$id";
			$res = mysqli_query($conexion, $consulta) or die("Problema con la conexion!!!!");
			if($res){
				return true;
            }
            else
            {
				return false;
			}
        }
        public function eliminarPrestamo($id_prestamo, $id_libro)
        {
            include("../connection/database.php");
            $consulta_prestamo = "DELETE FROM PRESTAMOS WHERE ID=$id_prestamo";
            $res = mysqli_query($conexion, $consulta_prestamo) or die("Problema con la conexion!!!!");

            $consulta_libro = "UPDATE LIBROS SET ESTADO_LIBRO=0 WHERE ID='$id_libro';";
            $query_libros = mysqli_query($conexion, $consulta_libro) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            
			if($res){
				echo "<script type='text/javascript'>
                alert('libro Entregado Exitosamente!!!');
                window.location='../templates/index.php';
                </script>";
            }
            else
            {
				echo "<script type='text/javascript'>
                alert('Tenemos un problema, regresa luegos!!!');
                window.location='../templates/index.php';
                </script>";
			}
        }
    } 
?>