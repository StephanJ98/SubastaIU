
<!-- Página html -->
<!-- Nombre: EntregaET2.html-->
<!-- Autor: cvy3ms  -->
<!-- Fecha de creación: 19/11/2017 -->
<!-- Función: el objetivo de este fichero es representar la estructura de la página web. En ella se presentan una cabecera, -->
<!-- un menú lateral, espacio de trabajo y un pie. Respecto al espacio de trabajo, en él se encuentra un ejemplo de texto,  -->
<!-- acompañado de una imagén e hipervinculos, y los formularios usados para que el usuario pueda insertar, buscar y editar -->
<!-- la información que requiera. Además se incluyen tres ejemplos de tablas: SHOWALL, DELETE y SHOWCURRENT. -->
 

 <?php
//entrada a la aplicacion

//se va usar la session de la conexion
session_start();

//funcion de autenticacion
include './Functions/Authentication.php';

//si no ha pasado por el login de forma correcta
if (!IsAuthenticated()){
	header('Location:./Controllers/Login_Controller.php');
}
//si ha pasado por el login de forma correcta 
else{
	header('Location:./Controllers/Index_Controller.php');
}

?>  