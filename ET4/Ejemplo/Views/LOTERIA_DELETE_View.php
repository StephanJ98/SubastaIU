<?php
/*  Archivo php
	Nombre: LOTERIA_DELETE_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de la tabla de borrado(delete) realizada con una clase donde se muestran todos los datos de un usuario y da la opción de borrarlos
*/
class LOTERIA_DELETE {

	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}

	function render( $valores ) {
		$this->valores = $valores;
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Tabla de borrado'];?>
			</h2>
			<table>
				
			<tr>
				<th>
					<?php echo $strings['Correo electrónico'];?>
				</th>
				<td>
					<?php echo $this->valores['email'] ?>
				</td>
			</tr>
			
			<tr>
				<th>
					<?php echo $strings['Nombre'];?>
				</th>
				<td>
					<?php echo $this->valores['nombre'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Apellidos'];?>
				</th>
				<td>
					<?php echo $this->valores['apellidos'] ?>
				</td>
			</tr>

			<tr>
				<th>
					<?php echo $strings['participacion'];?>
				</th>
				<td>
					<?php echo $this->valores['participacion'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['resguardo'];?>
				</th>
				<td>
					<img src="<?php echo $this->valores['resguardo']?>">
						<?php echo $this->valores['resguardo']?>
					</a>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['ingresado'];?>
				</th>
				<td>
					<?php echo $this->valores['ingresado'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['premiopersonal'];?>
				</th>
				<td>
					<?php echo $this->valores['premiopersonal'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['pagado'];?>
				</th>
				<td>
					<?php echo $this->valores['pagado'] ?>
				</td>
			</tr>
			</table>
			<p style="text-align:center;">
				<?php echo $strings['¿Está seguro de que quiere borrar esta tupla de la tabla?'];?>
			</p>
			<form action="../Controllers/LOTERIA_CONTROLLER.php" method="post" style="display: inline">
				<input type="hidden" name="email" value=<?php echo $this->valores['email'] ?> />
				<input type="hidden" name="nombre" value=<?php echo $this->valores['nombre'] ?> />
				<input type="hidden" name="apellidos" value=<?php echo $this->valores['apellidos'] ?> />
				<input type="hidden" name="participacion" value=<?php echo $this->valores['participacion'] ?> />
				<input type="hidden" name="resguardo" value=<?php echo $this->valores['resguardo'] ?> />
				<input type="hidden" name="ingresado" value=<?php echo $this->valores['ingresado'] ?> />
				<input type="hidden" name="premiopersonal" value=<?php echo $this->valores['premiopersonal'] ?> />
				<input type="hidden" name="pagado" value=<?php echo $this->valores['pagado'] ?> />
				<button type="submit" name="action" value="DELETE"><img src="../Views/icon/confirmar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
			<form action='../Controllers/LOTERIA_CONTROLLER.php' method="post" style="display: inline">
				<button type="submit"><img src="../Views/icon/cancelar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
		</div>
<?php
		include '../Views/Footer.php';
	}
}

?>