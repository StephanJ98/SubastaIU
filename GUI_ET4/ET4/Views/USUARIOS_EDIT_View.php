<?php
class USUARIOS_EDIT {

	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}

	function render( $valores ) {
		$this->valores = $valores;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
		?>
		<div class="container seccion">
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Formulario de modificación'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<form name="EDIT" action="../Controllers/USUARIO_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarEdit()">
					<table>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Nombre de Usuario'];?>
							</th>
							<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['idUser']?>" maxlength="30" size="34"  readonly onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')" required/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Contraseña'];?>
							</th>
							<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['password']?>" maxlength="128" size="128" onBlur="comprobarVacio(this) && comprobarLongitud(this,128) && comprobarTexto(this,128)" required/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Nombre'];?>
							</th>
							<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['nombre']?>" maxlength="150" size="154" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'150') && comprobarTexto(this,'150') && comprobarAlfabetico(this,'150')"/>
						</tr>
	                    <tr>
							<th class="formThTd">
								<?php echo $strings['Correo electrónico'];?>
							</th>
							<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['email']?>" maxlength="60" size="70" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)" required/>
						</tr>
	                    <tr>
							<th class="formThTd">
								<?php echo $strings['Avatar'];?>
							</th>
							<td class="formThTd">
								<a href="<?php echo $this->valores['avatar']?>" alt="<?php echo $strings['Avatar'];?>">
									<?php echo $this->valores['avatar']?></a>
								<p style="font-size: 12px"><?php echo $strings['Seleccione una nueva foto personal si desea cambiarla, en caso contrario, no es necesario seleccionarla de nuevo.'];?></p>
						
								<input type="file" id="avatar" name="avatar" value="<?php echo $this->valores['avatar']?>" accept="image/*"  />
						</tr>
						<?php
						if ($_SESSION['rol'] == 0) {
							?>
							<tr>
							<th class="formThTd">
								<?php echo $strings['Rol'];?>
							</th>
							<td class="formThTd"><input type="text" id="rol" name="rol"  value="<?php echo $this->valores['rol']?>" maxlength="1" size="1" onBlur="comprobarVacio(this) && comprobarLongitud(this,'1') && comprobarEntero(this,'0','3')"/>
							</tr>
						<?php
						}
						?>
	                    <tr>
							<td colspan="2">
								<button type="submit" name="action" value="EDIT"><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
							</tr>
					</table>
				</form>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/USUARIO_Controller.php' style="display: inline">
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