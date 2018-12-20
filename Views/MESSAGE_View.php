<?php
/*  Archivo php
	Autor: 	GUI
	Fecha de creación: 10/12/2018 
	Función: vista de un mensaje(message) realizada con una clase donde se muestra el mensaje deseado
*/
class MESSAGE { // declaración de la función
	function __construct( $text, $ruta ) {
		$this->text = $text;
		$this->ruta = $ruta;
		$this->render();
	}
	function render(){
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<br>
		<br>
		<br>
		<?php
			echo $strings[$this->text]; // se muestra por pantalla el texto
		?>
		<br>
		<br>
		<br>
		<form action='<?php $this->ruta?>'>
			<button type="submit">Atras</button>
		</form>
<?php
	include '../Views/Footer.php';
	}
}
?>