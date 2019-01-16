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
		<div class="container seccion" >
			<h2>
				<?php echo $strings['Tabla de datos'];?>
			</h2>
			<table>
				<caption style="margin-bottom:10px;margin: 10px;">
					<form action='../Controllers/HISTORIAL_Controller.php'>

					</form>
				</caption>
				<tr>
<?php
					foreach ( $lista as $atributo ) {
?>
					<th>
						<?php echo $strings[$atributo]?>
					</th>
<?php
					}
?>

				</tr>
<?php
				while ( $fila = mysqli_fetch_array( $this->datos ) ) {
?>
				<tr>
<?php
					foreach ( $lista as $atributo ) {
?>
					<td>
<?php
    					if($atributo == 'avatar'){
?>
						<img src="<?php echo $fila['avatar']?>" alt="<?php echo $strings['Avatar'];?>" style="width: 20px"></a>
<?php
						} else {
							echo $fila[ $atributo ];
						}
?>
					</td>
<?php
					}
?>					<td>
<form action="../Controllers/HISTORIAL_Controller.php" method="get" style="display:inline" >
	<input type="hidden" name="idSubasta" value="<?php echo $fila['idSubasta']; ?>">
<td>
		
<td>
		
</form>

</tr>
<?php
}
?>
		<br>
<?php 
	include '../Views/Footer.php';
		}
	}
?>