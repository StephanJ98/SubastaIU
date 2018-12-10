<?php
/*  Archivo php
	Nombre: Register_View.php
	Autor: 	cvy3ms
	Fecha de creación: 23/11/2018 
	Función: vista del formulario de registro(register) realizada con una clase donde se muestran todos los campos necesarios para añadir un nuevo usuario a la base de datos
*/
class Register {

	function __construct() {
		$this->render();
	}

	function render() {
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php'; //header necesita los strings
		?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Registro']; ?>
			</h2>
			<form name="ADD" action='../Controllers/Register_Controller.php' method="post" enctype="multipart/form-data" onsubmit="return comprobarAdd();">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Usuario']; ?>
						</th>
						<td class="formThTd"><input type="text" id="login" name="login" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="15" size="20" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'15') && comprobarTexto(this,'15')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña']; ?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="20" size="25" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['DNI']; ?>
						</th>
						<td class="formThTd"><input type="text" id="DNI" name="DNI" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="9" size="11" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'9') && comprobarTexto(this,'9') && comprobarDni(this)"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre']; ?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="30" size="34" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30') && comprobarAlfabetico(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Apellidos']; ?>
						</th>
						<td class="formThTd"><input type="text" id="apellidos" name="apellidos" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="50" size="60" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'50') && comprobarTexto(this,'50') && comprobarAlfabetico(this,'50')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Teléfono']; ?>
						</th>
						<td class="formThTd"><input type="text" id="telefono" name="telefono" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="11" size="13" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'11') && comprobarTexto(this,'11') && comprobarTelf(this)"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico']; ?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...'] ?>" value="" maxlength="60" size="70" required onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Fecha de Nacimiento']; ?>
						</th>
						<td class="formThTd"><input type="text" id="FechaNacimiento" name="FechaNacimiento" class="tcal" value="" readonly size="15" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Foto personal']; ?>
						</th>
						<td class="formThTd"><input type="file" id="fotopersonal" name="fotopersonal" value="" required accept="image/*" onblur="comprobarVacio(document.forms['ADD'].elements[7])"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Sexo']; ?>
						</th>
						<td class="formThTd">
							<select id="sexo" name="sexo" value="" required onBlur="comprobarVacio(document.forms['ADD'].elements[7]) && comprobarVacio(document.forms['ADD'].elements[8]) && comprobarVacio(this) ">
								<option value="">
									<?php echo $strings['Elija sexo']; ?>
								</option>
								<option value="hombre">
									<?php echo $strings['Hombre']; ?>
								</option>
								<option value="mujer">
									<?php echo $strings['Mujer']; ?>
								</option>
							</select>
					</tr>
					<tr>
						<td colspan="2">
							<button type="submit" name="action" value="REGISTER"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario'] ?>" /></button>
			</form>
				<a href='../index.php'><img src="../Views/icon/atras.png" width="32" height="32" alt="<?php echo $strings['Atras'] ?>"></a>
					</tr>
			</table>

		</div>

		<?php
		include '../Views/Footer.php';
		} //fin metodo render

		} //fin REGISTER

		?>