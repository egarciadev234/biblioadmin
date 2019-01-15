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
            <!--<ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Solicitar Prestamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tus Prestamos</a>
                </li>
                <ul  class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../routing/logout.php">Salir</a>
                    </li>
                </ul>
            </ul>-->
            <ul class="nav justify-content-center">
                <li class="nav-item"> 
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar_usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Libros</a>
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
            <a class="btn btn-success" href="agregar_libro.php">nuevo libro</a>
            <h1>Libros en Stand</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha de Publicación</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../books/crud_books.php");
                        $libro = new Libro();
                        $cont = 0;
                        $d = $libro->listarLibros();
                        while($dato = mysqli_fetch_array($d))
                        {
                            echo "<tr>";
                            echo "<td>" . "<strong>".$dato["TITULO"] ."</strong>" . "</td>";
                            echo "<td>" . $dato["FECHA_PUBLICACION"] . "</td>";
                            echo "<td>" . $dato["EDITORIAL"] . "</td>";
                            echo "<td>" . $dato["ISBN"] . "</td>";
                            echo "<td>" . "<a href='../routing/ver_ejemplares.php?id=$dato[ID]' class='btn btn-primary'>Ver Ejemplares</a> " . "<a href='../routing/ver_libro.php?id=$dato[ID]&ope=update' class='btn btn-warning'>Modificar</a>". " ". "<a href='../routing/ver_libro.php?id=$dato[ID]&ope=disable' class='btn btn-danger'>Deshabilitar</a>" . "</td>";
                            echo "</tr>";
                        }   
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>