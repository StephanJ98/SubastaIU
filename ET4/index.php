<!-- Autor: GUI  -->
<!-- Fecha de creación: 10/12/2018 -->
 
 <?php
//entrada a la aplicacio n
//se va usar la session de la conexion
session_start();
//funcion de autenticacion
include './Functions/Authentication.php';
//si no ha pasado por el login de forma correcta
if (!IsAuthenticated()){
	header('Location:./Controllers/LOGIN_Controller.php');
}
//si ha pasado por el login de forma correcta 
else{
	header('Location:./Controllers/USUARIO_Controller.php');
}
?>
