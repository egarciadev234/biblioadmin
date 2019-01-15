<?php
    /*
        Este documento son las consultas sql referentes a la tabla LIBROS de la
        base de datos, mediante el cual se pueden agregar, modificar, eliminar y deshabilitar
        libros
    */ 
    class Libro
    {   
        public function listarLibros()
        {   
            include("../connection/database.php");
            $consulta = "SELECT * FROM LIBROS";
            $query_libros = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            return $query_libros;
        }
        public function listarEjemplares($id)
        {
            include("../connection/database.php");
            $consulta_ejemplares = "SELECT * FROM EJEMPLARES WHERE EJEMPLAR = '$id';";
            $consulta_libro = "SELECT * FROM LIBROS WHERE ID = '$id';";
            return header("location:../templates/ejemplares.php?data=$consulta_ejemplares&lib=$consulta_libro");
        }
        public function agregarLibro($nuevo_libro)
        {
            include("../connection/database.php");
            $titulo = $_POST['inputTitulo'];
            $consulta_libros = "INSERT INTO LIBROS VALUES(null, '$nuevo_libro[0]', '$nuevo_libro[1]', '$nuevo_libro[2]',
            '$nuevo_libro[3]', '$nuevo_libro[4]', '$nuevo_libro[5]', 0, 0);";
            $query_nuevo_libro = mysqli_query($conexion, $consulta_libros) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
            
            $libros_creados = "SELECT ID FROM LIBROS WHERE ISBN = '$nuevo_libro[1]';";
            $query_creados  =mysqli_query($conexion, $libros_creados) or die("Ha fallado la consulta, Intentalo luego!!!");
            $id_libro = mysqli_fetch_array($query_creados);
            for ($i=1; $i <= $nuevo_libro[6]; $i++)
            { 
                $consulta_ejemplares = "INSERT INTO EJEMPLARES VALUES(null, '$id_libro[ID]', 0)";
                $query_creados = mysqli_query($conexion, $consulta_ejemplares) or die("Problema con la conexion!!!!");
            }
            echo "<script type='text/javascript'>
            alert('Nuevo libro registrado Exitosamente!!!');
            window.location='../templates/index.php';
            </script>";
        }
        public function modificarLibro($id)
        {
            $consulta_libro = "SELECT * FROM LIBROS WHERE ID = '$id';";
            return header("location:../templates/modificar_libro.php?data=$consulta_libro");

        }
        public function updateLibro($id, $modificacion_libro)
        {
            include("../connection/database.php");
            $consulta = "UPDATE LIBROS SET TITULO='$modificacion_libro[0]', ISBN='$modificacion_libro[1]', AUTOR='$modificacion_libro[2]', EDITORIAL='$modificacion_libro[3]', NO_PAGINAS='$modificacion_libro[4]', FECHA_PUBLICACION='$modificacion_libro[5]' WHERE ID=$id";
			$res = mysqli_query($conexion, $consulta) or die("Problema con la conexion!!!!");
			if($res){
				echo "<script type='text/javascript'>
                alert('libro modificado Exitosamente!!!');
                window.location='../templates/index.php';
                </script>";
            }
            else
            {
				echo "<script type='text/javascript'>
                alert('No se pudo modificar la informacion del Libro!!!');
                window.location='../templates/index.php';
                </script>";
			}
        }

        public function deshabilitarLibro($id)
        {
            include("../connection/database.php");
            $consulta = "UPDATE LIBROS SET DESHABILITAR= 1 WHERE ID=$id";
			$res = mysqli_query($conexion, $consulta) or die("Problema con la conexion!!!!");
			if($res){
				echo "<script type='text/javascript'>
                alert('libro deshabilitado Exitosamente!!!');
                window.location='../templates/index.php';
                </script>";
            }
            else
            {
				echo "<script type='text/javascript'>
                alert('No se pudo deshabilitar la informacion del Libro!!!');
                window.location='../templates/index.php';
                </script>";
			}
        }
    }
?>