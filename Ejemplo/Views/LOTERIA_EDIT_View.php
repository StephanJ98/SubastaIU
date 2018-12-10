<?php
/*  Archivo php
	Nombre: LOTERIA_EDIT_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de el formulario de editar(edit) realizada con una clase donde se muestran todos los campos posibles a modificar para cambiar los datos de un usuario en la base de datos
*/
class LOTERIA_EDIT {

	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}

	function render( $valores ) {
		$this->valores = $valores;
		/*include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';*/
		include '../Views/Header.php';
		?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Formulario de modificación'];?>
			</h2>
			<form name="EDITLOT" action="../Controllers/LOTERIA_CONTROLLER.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarEditLot()">
				<table>
										<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" value="<?php echo $this->valores['email']?>" maxlength="60" size="60" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)" readonly/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['nombre'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" value="<?php echo $this->valores['nombre']?>" maxlength="30" size="34" onBlur="comprobarVacio(this) && sinEspacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Apellidos'];?>
						</th>
						<td class="formThTd"><input type="text" id="apellidos" name="apellidos" value="<?php echo $this->valores['apellidos']?>" maxlength="40" size="40" onBlur="comprobarVacio(this) && comprobarLongitud(this,'40') && comprobarTexto(this,'40') && comprobarAlfabetico(this,'40')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['participacion'];?>
						</th>
						<td class="formThTd"><input type="text" id="participacion" name="participacion" value="<?php echo $this->valores['participacion']?>" maxlength="3" size="3" onBlur="comprobarVacio(this) && comprobarLongitud(this,'3') && comprobarTexto(this,'3')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['resguardo'];?>
						</th>
						<td class="formThTd">
							<img src="<?php echo $this->valores['resguardo']?>">
							<input type="file" id="resguardo" name="resguardo" value="<?php echo $this->valores['resguardo']?>" accept="image/*"  />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['ingresado'];?>
						</th>
						<td class="formThTd">
							<select id="ingresado" name="ingresado" value=""onblur="comprobarVacio(this);">
								<option value="<?php echo $this->valores['ingresado']?>">
									<?php echo $this->valores['ingresado']?>
								</option>
								<option value="SI">
									<?php echo $strings['SI'];?>
								</option>
								<option value="NO">
									<?php echo $strings['NO'];?>
								</option>
							</select>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['premiopersonal'];?>
						</th>
						<td class="formThTd"><input type="text" id="premiopersonal" name="premiopersonal"  value="<?php echo $this->valores['premiopersonal']?>" maxlength="6" size="6" onBlur="comprobarVacio(this) && comprobarLongitud(this,'6') && comprobarEntero(this,'1','999999')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['pagado'];?>
						</th>
						<td class="formThTd">
							<select id="pagado" name="pagado" value=""onblur="comprobarVacio(this)">
								<option value="<?php echo $this->valores['pagado']?>">
									<?php echo $this->valores['pagado']?>
								</option>
								<option value="SI">
									<?php echo $strings['SI'];?>
								</option>
								<option value="NO">
									<?php echo $strings['NO'];?>
								</option>
							</select>
					</tr>
					<tr>
						<td colspan="2">
							<button type="submit" name="action" value="EDIT"><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
			<form action='../Controllers/LOTERIA_CONTROLLER.php' style="display: inline">
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