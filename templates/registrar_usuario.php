<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
        <script src="../statics/rectificar_vencimientos.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../statics/bootstrap.css"/>
        <script src="../statics/bootstrap.js" type="text/javascript"></script>
        <script src="../statics/verify.js" type="text/javascript"></script>
    </head>
    <body>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Iniciar Sesion</a>
            </li>
        </ul>
        <h1>Registrese</h1>
        <form action="../routing/nuevo_usuario.php" method="post" onsubmit="verifyPass()">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNombre">Nombre Completo</label>
                    <input type="text" class="form-control" name="inputNombre">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTelefono">Telefono</label>
                    <input type="text" class="form-control" name="inputTelefono">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" name="inputEmail">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword">Contraseña</label>
                    <input type="password" class="form-control" name="inputPassword" id="inputPassword">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputVerifyPassword">Verificar Contraseña</label>
                    <input type="password" class="form-control" name="inputVerifyPassword" id="inputVerifyPassword">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input href="index.php" class="btn btn-success" type="submit" value="Registrarse"/>
                </div>
            </div>
        </form>
    </body>
</html>