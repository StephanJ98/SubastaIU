<?php
/*
	Autor: 	GUI
	Fecha de creación: 11/12/2018 
	Función: controla el cambio de idioma
*/
	session_start();
	$idioma = $_POST['idioma'];
	$_SESSION['idioma'] = $idioma;
	header('Location:' . $_SERVER["HTTP_REFERER"]);
?>