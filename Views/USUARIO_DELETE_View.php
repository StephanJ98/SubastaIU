<?php
class USUARIO_DELETE {

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
						<?php echo $strings['Nombre de Usuario'];?>
					</th>
					<td>
						<?php echo $this->valores['idUser']?>
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
						<?php echo $strings['Nombre y apellidos'];?>
					</th>
					<td>
						<?php echo $this->valores['nombre']?>
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
						<?php echo $strings['Avatar'];?>
					</th>
					<td>
						<a href="<?php echo $this->valores['avatar']?>" alt="<?php echo $strings['avatar'];?>">
							<?php echo $this->valores['avatar']?>
						</a>
					</td>
				</tr>
                <tr>
                    <th>
                        <?php echo $strings['Rol'];?>
                    </th>
                    <td>
                        <?php echo $this->valores['userRol']?>
                    </td>
                </tr>
                <p style="text-align:center;">
				<?php echo $strings['¿Está seguro de que quiere borrar esta tupla de la tabla?'];?>
			</p>
			<form action="../Controllers/USUARIO_CONTROLLER.php" method="post" style="display: inline">
				<input type="hidden" name="idUser" value=<?php echo $this->valores['idUser'] ?> />
				<input type="hidden" name="password" value=<?php echo $this->valores['password'] ?> />
				<input type="hidden" name="nombre" value=<?php echo $this->valores['nombre'] ?> />
				<input type="hidden" name="email" value=<?php echo $this->valores['email'] ?> />
				<input type="hidden" name="avatar" value=<?php echo $this->valores['avatar'] ?> />
				<input type="hidden" name="userRol" value=<?php echo $this->valores['userRol'] ?> />
				<button type="submit" name="action" value="DELETE"><img src="../Views/icon/confirmar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
			<form action='../Controllers/USUARIO_CONTROLLER.php' method="post" style="display: inline">
				<button type="submit"><img src="../Views/icon/cancelar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
		</div>
<?php
		include '../Views/Footer.php';
	}
}

?>