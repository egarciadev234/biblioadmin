<?php
    require_once("../auth/auth.php");
    $auth = new Auth();
    if (!$auth->userIsAuth())
    {
        header('Location: login.php'); 
    }
    else
    {
        require_once("../users/crud_users.php");
        $nuevo_usuario = new Usuario();
        $rol_usuario = $nuevo_usuario->verRolUsuario($_SESSION['user']);
        if($rol_usuario == 1)
        {
            header('Location: ../templates/mis_prestamos.php'); 
        }
    }
?> 
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
        <script src="../statics/rectificar_vencimientos.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../statics/bootstrap.css"/>
        <script src="../statics/bootstrap.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
        <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="solicitar_prestamo.php">Solicitar Prestamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="mis_prestamos.php">Tus Prestamos</a>
                </li>
                <ul  class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../routing/logout.php">Salir</a>
                    </li>
                </ul>
            </ul>
            <h1>Tus Prestamos</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Libro</th>
                        <th scope="col">Fecha de Prestamo</th>
                        <th scope="col">Fecha de Entrega</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../books/buscar_vencimientos.php");
                        require_once("../books/crud_paydays.php");
                        require_once("../books/crud_books.php");
                        include("../connection/database.php");
                        $prestamos = new Prestamo();
                        $cont = 0;
                        $d = $prestamos->misPrestamos();
                        
                        $consulta_mis_prestamos = "SELECT * FROM PRESTAMOS WHERE USUARIO = '$d';";
                        $query_datos = mysqli_query($conexion, $consulta_mis_prestamos) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
                        
                        
                        
                        while($dato = mysqli_fetch_array($query_datos))
                        {
                            echo "<tr>";
                            $consulta = "SELECT * FROM LIBROS WHERE ID=$dato[LIBROS_PRESTADOS]";
                            $query_libros = mysqli_query($conexion, $consulta) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
                            while($libro = mysqli_fetch_array($query_libros))
                            {
                                echo "<td><strong>" . $libro["TITULO"] . "</strong></td>";
                            }
                            echo "<td>" . $dato["FECHA_PRESTAMO"] . "</td>";
                            echo "<td>" . "<strong>".$dato["FECHA_ENTREGA"] ."</strong>" . "</td>";
                            if($dato["ESTADO_PRESTAMO"] == 0)
                            {
                                echo "<td class='text-success'>" . "<strong>En Vigencia</strong>" . "</td>";
                            }
                            else
                            {
                                echo "<td class='text-danger'>" . "<strong>Vencido</strong>" . "</td>";
                            }
                            echo "<td>" . "<a href='../routing/devolver_libro.php?id=$dato[ID]&libro=$libro[ID]' class='btn btn-primary'>Devolver Libro</a> ";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>