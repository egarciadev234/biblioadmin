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
        if($rol_usuario == 1)
        {
            header('Location: ../templates/index.php'); 
        }
    }
?>
<html>
    <head>
        <title>solicitar Prestamo</title>
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
                    <a class="nav-link active" href="solicitar_prestamo.php">Solicitar Prestamo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mis_prestamos.php">Tus Prestamos</a>
                </li>
                <ul  class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../routing/logout.php">Salir</a>
                    </li>
                </ul>
            </ul>
            <h1>Solicita tus libros Favoritos</h1>
            <h3>Selecciona: </h3>
            <form>
                <div class="form-row">
                    <input type="hidden" class="form-control" name="inputUser" id="inputUser" value="<?php echo $_SESSION['user'];?>">
                    <div class="form-group col-md-6">
                        <label for="inputFechaEntrega">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="inputFechaEntrega">
                    </div>
                    <div class="form-group col-md-6">
                        <fielset>
                            <select class="form-control"  id="choice" multiple="multiple">
                                <option value=" ">Selecciona tus libros</option>
                                <?php 
                                    include("../books/crud_paydays.php");
                                    $libros = new Prestamo();
                                    $cont = 0;
                                    $d = $libros->solicitarPrestamo();
                                    while($dato = mysqli_fetch_array($d))
                                    {
                                        if($dato["DESHABILITAR"] == 0)
                                        {
                                            if($dato["ESTADO_LIBRO"] != 1)
                                            {
                                                echo "<option value='$dato[ID]'>". $dato["TITULO"] ."</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </fielset>
                        <script type="text/javascript">
                            function showChoices()
                            {
                                var selLibro = document.getElementById("choice");
                                var result = "<h3>Has Seleccionado: </h3>";
                                result += "<ul>";
                                var seleccion = [];
                                for (i = 0; i < selLibro.length; i++)
                                {
                                    currentOption = selLibro[i];
                                    if (currentOption.selected == true)
                                    {
                                        result += " <li>" + currentOption.text + "</li>";
                                        seleccion.push(currentOption.value);
                                    }
                                }
                                result += "</ul>";
                                output = document.getElementById("output");
                                output.innerHTML = result;
                                
                                $('#enviar').click(function(){
                                    var fecha_entrega = document.getElementById("inputFechaEntrega");
                                    var sel_user = document.getElementById("inputUser");

                                    fecha_prestamo =  fechaActual();
                                    $.ajax(
                                    { 
                                        type: 'POST', 
                                        url: '../routing/sincronizar_prestamo.php?f_e='+fecha_entrega.value+'&user='+sel_user.value+'&f_p='+fecha_prestamo, 
                                        data: {'array': JSON.stringify(seleccion)},
                                        success:(function(data){
                                            alert("Se han enviado los datos EXITOSAMENTE");
                                            window.location='../templates/mis_prestamos.php'
                                        })
                                    });
                                });
                            }
                            
                            function fechaActual()
                            {
                                var hoy = new Date();
                                var dd = hoy.getDate();
                                var mm = hoy.getMonth()+1;
                                var yyyy = hoy.getFullYear();
                                dd = addZero(dd);
                                mm = addZero(mm);
                                return yyyy+'-'+mm+'-'+dd;
                            }
                            function addZero(i) {
                                if (i < 10) {
                                    i = '0' + i;
                                }
                                return i;
                            }
                        </script>
                        <div id = "output">

                        </div>
                        <button class="btn btn-success btn-sm float-right" type = "button" onclick = "showChoices();">Verificar seleccionados</button>
                    </div>
                <button id="enviar" class="btn btn-primary" type = "button" >Solicitar Libros</button>
            </form>
        </div>
    </body>
</html>