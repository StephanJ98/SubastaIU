<?php
/*  Archivo php
	Nombre: USUARIOS_EDIT_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de el formulario de editar(edit) realizada con una clase donde se muestran todos los campos posibles a modificar para cambiar los datos de un usuario en la base de datos
*/
class USUARIOS_EDIT {

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
				<?php echo $strings['Formulario de modificación'];?>
			</h2>
			<form name="EDIT" action="../Controllers/USUARIOS_CONTROLLER.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarEdit()">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Usuario'];?>
						</th>
						<td class="formThTd"><input type="text" id="login" name="login" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['login']?>" maxlength="15" size="20"  readonly onBlur="comprobarVacio(this) && comprobarLongitud(this,'15') && comprobarTexto(this,'15')" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña'];?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['password']?>" maxlength="128" size="128" onBlur="comprobarVacio(this) && comprobarLongitud(this,128) && comprobarTexto(this,128)" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['DNI'];?>
						</th>
						<td class="formThTd"><input type="text" id="DNI" name="DNI" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['DNI']?>" maxlength="9" size="11" onBlur="comprobarVacio(this) && comprobarLongitud(this,'9') && comprobarTexto(this,'9') && comprobarDni(this)" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['nombre']?>" maxlength="30" size="34" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30') && comprobarAlfabetico(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Apellidos'];?>
						</th>
						<td class="formThTd"><input type="text" id="apellidos" name="apellidos" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['apellidos']?>" maxlength="50" size="60" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'50') && comprobarTexto(this,'50') && comprobarAlfabetico(this,'50')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Teléfono'];?>
						</th>
						<td class="formThTd"><input type="text" id="telefono" name="telefono" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['telefono']?>" maxlength="11" size="13" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'11') && comprobarTexto(this,'11') && comprobarTelf(this)"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['email']?>" maxlength="60" size="70" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Fecha de Nacimiento'];?>
						</th>
						<td class="formThTd"><input type="text" id="FechaNacimiento" name="FechaNacimiento" class="tcal" value="<?php echo $this->valores['FechaNacimiento']?>" readonly size="15" required/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Foto personal'];?>
						</th>
						<td class="formThTd">
							<a href="<?php echo $this->valores['fotopersonal']?>" alt="<?php echo $strings['Foto personal'];?>">
								<?php echo $this->valores['fotopersonal']?></a>
							<p style="font-size: 12px"><?php echo $strings['Seleccione una nueva foto personal si desea cambiarla, en caso contrario, no es necesario seleccionarla de nuevo.'];?></p>
					
							<input type="file" id="fotopersonal" name="fotopersonal" value="<?php echo $this->valores['fotopersonal']?>" accept="image/*"  />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Sexo'];?>
						</th>
						<td class="formThTd">
							<select id="sexo" name="sexo" value="<?php echo $this->valores['sexo']?>" required onBlur="comprobarVacio(this) && comprobarVacio(document.forms['EDIT'].elements[7])" >
								<option value="">
									<?php echo $strings['Elija sexo'];?>
								</option>
								<option value="hombre" <?php echo (($this->valores['sexo'])=='hombre')? "selected" : ""; ?>>
									<?php echo $strings['Hombre'];?>
								</option>
								<option value="mujer" <?php echo (($this->valores['sexo'])=='mujer')? "selected" : ""; ?>>
									<?php echo $strings['Mujer'];?>
								</option>
							</select>
					</tr>
					<tr>
						<td colspan="2">
							<button type="submit" name="action" value="EDIT"><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
			<form action='../Controllers/USUARIOS_CONTROLLER.php' style="display: inline">
				<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
			</form>
			</tr>

			</table>
		</div>

		<?php
		include '../Views/Footer.php';
		}
		}
		?>