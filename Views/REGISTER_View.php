<?php
/*  Autor: 	GUI
	Fecha de creación: 07/01/2019
	Función: vista del formulario de registro(register) realizada con una clase donde se muestran todos los campos necesarios para añadir un nuevo usuario a la base de datos
*/
class Register {

	function __construct() {
		$this->render();
	}

	function render() {
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php'; //header necesita los strings
		?>
		<div class="container section">
			<br>
			<br>
			<br>
			<div class="row justify-content-center">
			<h2>
				<?php echo $strings['Registro']; ?>
			</h2>
			<form name="ADD" action='../Controllers/REGISTER_Controller.php' method="post" enctype="multipart/form-data" onsubmit="return comprobarAdd();">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Usuario']; ?>
						</th>
						<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="30" size="34" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña']; ?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="20" size="25" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre']; ?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="150" size="154" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'150') && comprobarTexto(this,'150') && comprobarAlfabetico(this,'150')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico']; ?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="60" size="70" required onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Avatar']; ?>
						</th>
						<td class="formThTd"><input type="file" id="nombreFoto" name="nombreFoto" value="" required accept="image/*" onblur="comprobarVacio(document.forms['ADD'].elements[7])"/>
					</tr>
					<?php
					if (IsAuthenticated()){
						if ($_SESSION['rol'] == 0) {
					?>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Rol']; ?>
							</th>
							<td class="formThTd">
								<select id="rol" name="rol" value="" required onBlur="comprobarVacio(document.forms['ADD'].elements[7]) && comprobarVacio(document.forms['ADD'].elements[8]) && comprobarVacio(this) ">
									<option value="">
										<?php echo $strings['Elija rol']; ?>
									</option>
									<option value="1">
										<?php echo $strings['Pujador']; ?>
									</option>
									<option value="2">
										<?php echo $strings['Subastador']; ?>
									</option>
								</select>
						</tr>
						<?php
						}
					}
					else{
						?>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Rol']; ?>
							</th>
							<td class="formThTd">
							<select id="rol" name="rol" value="" required readonly>
								<option value="1">
									<?php echo $strings['Pujador']; ?>
								</option>
							</select>
						</tr>
					<?php
					}
					?>
					<tr>
						<td colspan="2">
							<button type="submit" name="action" value="REGISTER"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario'] ?>" /></button>
			</form>
				<a href='../index.php'><img src="../Views/icon/atras.png" width="32" height="32" alt="<?php echo $strings['Atras'] ?>"></a>
					</tr>
			</table>
		</div>
	</div>
	<?php
	include '../Views/Footer.php';
	} //fin metodo render
} //fin REGISTER
?>
