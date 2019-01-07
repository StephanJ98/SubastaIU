<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del footer
*/
    class PUJA_ADD { 
     function __construct() {
		$this->render();
	}
    
    function render() {
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>



<?php
		include '../Views/Footer.php';
		}
	}
?>