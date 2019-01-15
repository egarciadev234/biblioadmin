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
        if($rol_usuario == 0)
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
                    <a class="nav-link" href="listar_usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_prestamos.php">Prestamos</a>
                </li>
                <ul  class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../routing/logout.php">Salir</a>
                    </li>
                </ul>
            </ul>
            <h1>Ejemplares disponibles</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">EJEMPLAR</th>
                        <th scope="col">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../connection/database.php");
                        $ejemplares = $_GET["data"];
                        $libro = $_GET["lib"];

                        $query_ejemplares = mysqli_query($conexion, $ejemplares) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
                        $query_libro = mysqli_query($conexion, $libro) or die("Ha fallado la consulta Intentalo mas tarde!!!!");
                        
                        $datos_libro = mysqli_fetch_object($query_libro);

                        while($dato = mysqli_fetch_array($query_ejemplares))
                        {
                            echo "<tr>";
                            echo "<td>" . $dato["ID"] ."</td>";
                            echo "<td>" . $datos_libro->TITULO . "</td>";
                            if($dato["ESTADO"] == 0)
                            {
                                echo "<td class='text-success'>" . "<strong>Disponible</strong>" . "</td>";
                            }
                            else if($dato["ESTADO"] == 1)
                            {
                                echo "<td class='text-danger'>" . "<strong>Prestado</strong>" . "</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

