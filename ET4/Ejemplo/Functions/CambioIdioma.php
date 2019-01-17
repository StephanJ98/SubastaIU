<?php
/*
	Archivo php
	Nombre: CambioIdioma.php
	Autor: 	cvy3ms
	Fecha de creación: 23/11/2018 
	Función: controla el cambio de idioma
*/
	session_start();
	$idioma = $_POST['idioma'];
	$_SESSION['idioma'] = $idioma;
	header('Location:' . $_SERVER["HTTP_REFERER"]);
?>