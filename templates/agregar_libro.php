<?php
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
            <h1>Agregar nuevo libro</h1>
            <form action="../routing/nuevo_libro.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputTitulo">Titulo</label>
                        <input type="text" class="form-control" name="inputTitulo">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputISBN">ISBN</label>
                        <input type="text" class="form-control" name="inputISBN">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputautor">Autor</label>
                        <input type="text" class="form-control" name="inputAutor">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEditorial">Editorial</label>
                        <input type="text" class="form-control" name="inputEditorial">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPaginas"># Paginas</label>
                        <input type="number" class="form-control" name="inputPaginas">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPublicacion">Fecha de Publicacion</label>
                        <input type="date" class="form-control" name="inputPublicacion">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEjemplares"># Ejemplares</label>
                        <input type="number" class="form-control" name="inputEjemplares">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input href="index.php" class="btn btn-success" type="submit" value="Agregar"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>