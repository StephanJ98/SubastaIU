<?php
class USUARIOS_SHOWCURRENT {

	function __construct( $lista ) {
		$this->lista = $lista;
		$this->render( $this->lista );
	}

	function render( $lista ) {
		$this->lista = $lista;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
<div class="container section">
	<br>
	<br>
	<br>
	<div class="row justify-content-center">
		<h2>
			<?php echo $strings['Vista detallada'];?>
		</h2>
		<table class="tablaDatos">
			<tr>
				<th>
					<?php echo $strings['Nombre de Usuario'];?>
				</th>
				<td>
					<?php echo $this->lista['idUser'] ?>
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
					<?php echo $strings['Nombre'];?>
				</th>
				<td>
					<?php echo $this->lista['nombre'] ?>
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
					<?php echo $strings['Avatar'];?>
				</th>
				<td>
					<a href="<?php echo $this->lista['avatar']?>" alt="<?php echo $strings['Avatar'];?>">
						<?php echo $this->lista['avatar']?>
					</a>
				</td>
			</tr>
            <tr>
                <th>
                    <?php echo $strings['Rol'];?>
                </th>
                <td>
                    <?php echo $this->lista['rol']?>
                </td>
            </tr>
            <caption style="margin-top:10px;" align="bottom">
				<form action='../Controllers/USUARIO_Controller.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
				</form>
			</caption>
		</table>
	</div>
</div>
		<br>
		<br>
<?php
		include '../Views/Footer.php';
	}
}
?>
