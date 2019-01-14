<?php
/*
	Autor: 	GUI
	idSubasta de creación: 13/1/2019 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class USUARIOS_SHOWALL {

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
			<h2>
				<?php echo $strings['Tabla de datos'];?>
			</h2>
			<table>
				<caption style="margin-bottom:10px;margin: 10px;">
					<form action='../Controllers/USUARIO_Controller.php'>
						<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="BUSCAR" /></button>
						<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="AÑADIR" /></button>
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
?>
					<td>
						<form action="../Controllers/USUARIO_Controller.php" method="get" style="display:inline">
							<input type="hidden" name="idUser" value="<?php echo $fila['idUser']; ?>">
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
								?>
							<?php
							}
							?>
						</form>

				</tr>
<?php
				}
?>
			</table>
			<form action='../Controllers/USUARIO_Controller.php' method="post">
				<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
			</form>
		</div>
		<br>
		<br>
<?php 
	include '../Views/Footer.php';
		}
	}
?>