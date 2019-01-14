<?php
/*
	Autor: 	GUI
	idSubasta de creación: 13/1/2019 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class HISTORIAL_SHOWALL{
	function __construct( $lista, $datos) {
		$this->lista = $lista;
		$this->datos = $datos;
		$this->render($this->lista,$this->datos);
	}
	
	function render($lista,$datos){
		$this->lista = $lista;
		$this->datos = $datos;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<br>
		<br>
<?php 
	include '../Views/Footer.php';
		}
	}
?>