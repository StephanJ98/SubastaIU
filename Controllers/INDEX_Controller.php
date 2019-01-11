<?php
/*
	Autor: 	GUI
	Fecha de creación: 19/12/2018 
	Función: controlador que comprueba si el usuario está autenticado o  no
*/
//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//esta autenticado
else{
	include '../Views/INDEX_View.php';
	new Index();
}

?>