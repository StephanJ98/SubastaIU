<?php
/*  Archivo php
	Nombre: USUARIOS_DELETE_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de la tabla de borrado(delete) realizada con una clase donde se muestran todos los datos de un usuario y da la opción de borrarlos
*/
class USUARIOS_DELETE {

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
						<?php echo $strings['Usuario'];?>
					</th>
					<td>
						<?php echo $this->valores['login']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Contraseña'];?>
					</th>
					<td>
						<?php echo $this->valores['password']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['DNI'];?>
					</th>
					<td>
						<?php echo $this->valores['DNI']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Nombre'];?>
					</th>
					<td>
						<?php echo $this->valores['nombre']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Apellidos'];?>
					</th>
					<td>
						<?php echo $this->valores['apellidos']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Teléfono'];?>
					</th>
					<td>
						<?php echo $this->valores['telefono']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Correo electrónico'];?>
					</th>
					<td>
						<?php echo $this->valores['email']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Fecha de Nacimiento'];?>
					</th>
					<td>
						<?php echo $this->valores['FechaNacimiento']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Foto personal'];?>
					</th>
					<td>
						<a href="<?php echo $this->valores['fotopersonal']?>" alt="<?php echo $strings['Foto personal'];?>">
							<?php echo $this->valores['fotopersonal']?>
						</a>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['Sexo'];?>
					</th>
					<td>
						<?php echo $this->valores['sexo']?>
					</td>
				</tr>
			</table>
			<p style="text-align:center;">
				<?php echo $strings['¿Está seguro de que quiere borrar esta tupla de la tabla?'];?>
			</p>
			<form action="../Controllers/USUARIOS_CONTROLLER.php" method="post" style="display: inline">
				<input type="hidden" name="login" value=<?php echo $this->valores['login'] ?> />
				<input type="hidden" name="password" value=<?php echo $this->valores['password'] ?> />
				<input type="hidden" name="DNI" value=<?php echo $this->valores['DNI'] ?> />
				<input type="hidden" name="nombre" value=<?php echo $this->valores['nombre'] ?> />
				<input type="hidden" name="apellidos" value=<?php echo $this->valores['apellidos'] ?> />
				<input type="hidden" name="telefono" value=<?php echo $this->valores['telefono'] ?> />
				<input type="hidden" name="email" value=<?php echo $this->valores['email'] ?> />
				<input type="hidden" name="FechaNacimiento" value=<?php echo $this->valores['FechaNacimiento'] ?> />
				<input type="hidden" name="fotopersonal" value=<?php echo $this->valores['fotopersonal'] ?> />
				<input type="hidden" name="sexo" value=<?php echo $this->valores['sexo'] ?> />
				<button type="submit" name="action" value="DELETE"><img src="../Views/icon/confirmar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
			<form action='../Controllers/USUARIOS_CONTROLLER.php' method="post" style="display: inline">
				<button type="submit"><img src="../Views/icon/cancelar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
		</div>
<?php
		include '../Views/Footer.php';
	}
}

?>