<?php
class PUJA_SHOWALL {
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
		<div class="container seccion" >
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Tabla de datos'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<table>
					<caption style="margin-bottom:10px;margin: 10px;">
						<form action='../Controllers/PUJA_Controller.php'>
							<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="BUSCAR" /></button>
						</form>
					</caption>
					<tr>
	<?php
						foreach ( $lista as $atributo ) {
	?>
						<th>
							<?php echo $strings[$atributo]?>
						</th>
						<th><p>&nbsp&nbsp</p></th>
	<?php
						}
	?>
						<th colspan="3" >
							<?php echo $strings['Opciones']?>
						</th>
					</tr>
	<?php
					while ( $fila = mysqli_fetch_array( $this->datos ) ) {
	?>
					<tr>
	<?php
						foreach ( $lista as $atributo ) {
	?>
						<td>
							<?php echo $fila[ $atributo ];?>
						</td>
						<td><p>&nbsp&nbsp</p></td>
	<?php
						}
	?>
						<td>
							<form action="../Controllers/PUJA_Controller.php" method="get" style="display:inline" >
								<input type="hidden" name="idSubasta" value="<?php echo $fila['idSubasta']; ?>">
						<td>
									
						<td>
								<button type="submit" name="action" value="SHOWCURRENT" ><img src="../Views/icon/verDetalles.png" alt="<?php echo $strings['Ver en detalle']?>" width="20" height="20"/></button>
							</form>

					</tr>
	<?php
					}
	?>
				</table>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/PUJA_Controller.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
				</form>
			</div>
		</div>
		<br>
		<br>
<?php 
	include '../Views/Footer.php';
	}
}
?>