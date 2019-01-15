<?php
    require_once("../auth/auth.php");
    $auth = new Auth();
    if (!$auth->userIsAuth())
    {
        header('Location: login.php'); 
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
                    <a class="nav-link active" href="listar_prestamos.php">Prestamos</a>
                </li>
                <ul  class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../routing/logout.php">Salir</a>
                    </li>
                </ul>
            </ul>
            <h1>Usuarios Registrados</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Fecha de Prestamo</th>
                        <th scope="col">Fecha de Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../books/crud_paydays.php");
                        include("../users/crud_users.php");
                        $usuarios = new Usuario();
                        $prestamos = new Prestamo();
                        $cont = 0;
                        $d = $prestamos->listarPrestamos();
                        $users = $usuarios->listarUsuarios();
                        while($dato = mysqli_fetch_array($d))
                        {
                            echo "<tr>";
                            while($user = mysqli_fetch_array($users))
                            {
                                if($user["ID"] == $dato["USUARIO"])
                                {
                                    echo "<td>" . "<strong>".$user["NOMBRE_COMPLETO"] ."</strong>" . "</td>";
                                }
                            }
                            echo "<td>" . $dato["FECHA_PRESTAMO"] . "</td>";
                            echo "<td>" . $dato["FECHA_ENTREGA"] . "</td>";
                            echo "</tr>";
                        }   
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>