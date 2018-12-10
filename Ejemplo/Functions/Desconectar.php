<?php
/*
	Archivo php
	Nombre: Desconectar.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: realiza la desconexión de la sesión
*/
session_start();
session_destroy();
header('Location:../index.php');

?>
