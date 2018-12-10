<?php
/*  Archivo php
	Nombre: LOTERIA_SHOWCURRENT_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de la tabla de vista en detalle(showcurrent) realizada con una clase donde se muestran todos los datos de un usuario
*/
class LOTERIA_SHOWCURRENT {

	function __construct( $lista ) {
		$this->lista = $lista;
		$this->render( $this->lista );
	}

	function render( $lista ) {
		$this->lista = $lista;
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<h2>
			<?php echo $strings['Vista detallada'];?>
		</h2>
		<table class="tablaDatos">

			<tr>
				<th>
					<?php echo $strings['Correo electrónico'];?>
				</th>
				<td>
					<?php echo $this->lista['email'] ?>
				</td>
			</tr>
			
			<tr>
				<th>
					<?php echo $strings['Nombre'];?>
				</th>
				<td>
					<?php echo $this->lista['nombre'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Apellidos'];?>
				</th>
				<td>
					<?php echo $this->lista['apellidos'] ?>
				</td>
			</tr>

			<tr>
				<th>
					<?php echo $strings['participacion'];?>
				</th>
				<td>
					<?php echo $this->lista['participacion'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['resguardo'];?>
				</th>
				<td>
					<img src="<?php echo $this->lista['resguardo']?>">
						<?php echo $this->lista['resguardo']?>
					</a>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['ingresado'];?>
				</th>
				<td>
					<?php echo $this->lista['ingresado'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['premiopersonal'];?>
				</th>
				<td>
					<?php echo $this->lista['premiopersonal'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['pagado'];?>
				</th>
				<td>
					<?php echo $this->lista['pagado'] ?>
				</td>
			</tr>
			<caption style="margin-top:10px;" align="bottom">
				<form action='../Controllers/LOTERIA_CONTROLLER.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
				</form>
			</caption>
		</table>

<?php
		include '../Views/Footer.php';
	}
}
?>