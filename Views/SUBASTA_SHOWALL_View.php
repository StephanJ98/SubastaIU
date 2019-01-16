<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/1/2019 
	Función: contiene el array que permite la traducción de los textos a español
*/
class SUBASTA_SHOWALL {
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
						<form action='../Controllers/SUBASTA_Controller.php'>
							<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="BUSCAR" /></button>

							<?php
							if (($_SESSION['rol'] == 0) || ($_SESSION['rol'] == 2)) {
								?>
								<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="AÑADIR" /></button>
							<?php
							}
							?>
						</form>
					</caption>
					<tr>
	<?php
						foreach ( $lista as $atributo ) {
	?>
						<th>
							<?php echo $strings[$atributo];?>
						</th>
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
	    					if($atributo == 'ficheroSubasta'){
	?>
							<a><img src="<?php echo $fila['ficheroSubasta']?>" alt="<?php echo $strings['No hay Fichero'];?>" style="width: 20px"></a>
	<?php
							} else {
								echo $fila[ $atributo ];
							}
							if($fila['esCiega'] == 'true'){
								if ((($_SESSION['rol'] == 0) || ($_SESSION['idUser'] == $fila['idUser']))) {
								}
								else{
									$fila['mayorPuja'] = 'X';
								}
							}
	?>	
						</td>
	<?php
						}
	?>
						<td>
							<form action="../Controllers/SUBASTA_Controller.php" method="get" style="display:inline">
								<input type="hidden" name="idSubasta" value="<?php echo $fila['idSubasta']; ?>">
									<?php
									if (IsAuthenticated()){
										if (($_SESSION['rol'] == 0) || ($_SESSION['idUser'] == $fila['idUser'])) {
									?>
										<button type="submit" name="action" value="EDIT" ><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Modificar']?>" width="20" height="20" /></button>
						<td>
									<button type="submit" name="action" value="DELETE" ><img src="../Views/icon/eliminar.png" alt="<?php echo $strings['Eliminar']?>" width="20" height="20" /></button>
										<?php
										}
									}
									?>
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
				<form action='../Controllers/SUBASTA_Controller.php' method="post">
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