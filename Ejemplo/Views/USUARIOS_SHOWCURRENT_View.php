<?php
/*  Archivo php
	Nombre: USUARIOS_SHOWCURRENT_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de la tabla de vista en detalle(showcurrent) realizada con una clase donde se muestran todos los datos de un usuario
*/
class USUARIOS_SHOWCURRENT {

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
					<?php echo $strings['Usuario'];?>
				</th>
				<td>
					<?php echo $this->lista['login'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Contraseña'];?>
				</th>
				<td>
					<?php echo $this->lista['password'] ?>
				</td>
			</tr>

			<tr>
				<th>
					<?php echo $strings['DNI'];?>
				</th>
				<td>
					<?php echo $this->lista['DNI'] ?>
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
					<?php echo $strings['Teléfono'];?>
				</th>
				<td>
					<?php echo $this->lista['telefono'] ?>
				</td>
			</tr>
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
					<?php echo $strings['Fecha de Nacimiento'];?>
				</th>
				<td>
					<?php echo $this->lista['FechaNacimiento'] ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Foto personal'];?>
				</th>
				<td>
					<a href="<?php echo $this->lista['fotopersonal']?>" alt="<?php echo $strings['Foto personal'];?>">
						<?php echo $this->lista['fotopersonal']?>
					</a>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Sexo'];?>
				</th>
				<td>
					<?php echo $this->lista['sexo'] ?>
				</td>
			</tr>
			<caption style="margin-top:10px;" align="bottom">
				<form action='../Controllers/USUARIOS_CONTROLLER.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
				</form>
			</caption>
		</table>

<?php
		include '../Views/Footer.php';
	}
}
?>