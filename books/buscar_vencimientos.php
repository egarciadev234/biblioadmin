<?php
include("../books/crud_paydays.php");
require_once("../users/crud_users.php");
$usuario = new Usuario();
$email = '';
$alerta = null;
$prestamos = new Prestamo();
$cont = 0;
$d = $prestamos->listarPrestamos();

$fecha_actual =  date('Y') . "-" . date('m') . "-" . date('d');

while($dato = mysqli_fetch_array($d))
{
    $email= $usuario->verEmailUsuario($dato["USUARIO"]);
    if((string)$dato["FECHA_ENTREGA"] === $fecha_actual)
    {
        $prestamos->modificarPrestamo($dato["ID"]);
        $prestamos->alertarPrestamo($email);
    }
}
?>