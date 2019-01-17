<?php
/*
	Autor: 	GUI
	Fecha de creación: 11/12/2018 
	Función: realiza la desconexión de la sesión
*/
session_start();
session_destroy();
header('Location:../index.php');
?>