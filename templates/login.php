<html>
    <head>
        <title>Login</title>
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
                <a class="nav-link" href="registrar_usuario.php">Registrarse</a>
            </li>
        </ul>
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" action="../routing/validating_login.php">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2>Login</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <label class="sr-only" for="email">Email</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="you@example.com" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="sr-only" for="password">Contraseña</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 1rem">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Ingresar</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>