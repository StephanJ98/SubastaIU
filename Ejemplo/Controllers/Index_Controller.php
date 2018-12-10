<?php
/*
	Archivo php
	Nombre: Index_Controller.php
	Autor: 	cvy3ms
	Fecha de creación: 23/11/2018 
	Función: controlador que comprueba si el usuario está autenticado o no
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
	include '../Views/users_index_View.php';
	new Index();
}

?>