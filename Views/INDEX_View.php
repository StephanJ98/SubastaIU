<?php
/*  
	Autor: 	GUI
	Fecha de creación: 19/12/2018 
	Función: vista de los elementos que va a contar la sesión del usuario, realizada con una clase
*/
class Index {
	function __construct(){
		session_start();
		$this->render();
	}
	function render(){
		include '../Locales/SP.php';
		include '../Views/Header.php';
		include '../Views/Footer.php';
	}
}
?>