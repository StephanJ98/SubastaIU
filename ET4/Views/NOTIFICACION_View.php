<?php
/*
	Autor: 	GUI
	idSubasta de creación: 13/1/2019 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class NOTIFICACION {

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
	<?php
	    					echo $fila[ $atributo ];
	?>
							
						</td>
						<td><p>&nbsp&nbsp</p></td>
	<?php
						}
	?>
						<td>
							<form action="../Controllers/NOTIFICACION_Controller.php" method="get" style="display:inline">
								<input type="hidden" name="idNotificacion" value="<?php echo $fila['idNotificacion']; ?>">
								<?php
								if (IsAuthenticated()){
									if (($_SESSION['rol'] == 0) || ($_SESSION['idUser'] == $fila['idUser'])) {
								?>
											<button type="submit" name="action" value="EDIT" ><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Modificar']?>" width="20" height="20" /></button>
										<td>
											<button type="submit" name="action" value="DELETE" ><img src="../Views/icon/eliminar.png" alt="<?php echo $strings['Eliminar']?>" width="20" height="20" /></button>
										<td>
											<button type="submit" name="action" value="SHOWCURRENT" ><img src="../Views/icon/verDetalles.png" alt="<?php echo $strings['Ver en detalle']?>" width="20" height="20"/></button>
									<?php
									}
								}
								?>
							</form>

					</tr>
	<?php
					}
	?>
				</table>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/NOTIFICACION_Controller.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
				</form>
			</div>
		</div>
	<br>
	<br>
	<br>
<?php 
	include '../Views/Footer.php';
	}
}
?>