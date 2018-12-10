<?php
/*  Archivo php
	Nombre: LOTERIA_ADD_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2017 
	Función: vista de el formulario de añadir(add) realizada con una clase donde se muestran todos los campos a rellenar para añadir un usuario a la base de datos
*/
class LOTERIA_ADD {

	function __construct() {
		$this->render();
	}

	function render() {
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Formulario de inserción'];?>
			</h2>
			<form name="ADDLOT" action="../Controllers/LOTERIA_CONTROLLER.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarAddLot()">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="60" size="64" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)""/">
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['nombre'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="30" size = '34' value = '' onBlur="comprobarVacio(this) && sinEspacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')" />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Apellidos'];?>
						</th>
						<td class="formThTd"><input type="text" id="apellidos" name="apellidos" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="40" size = '44' value = '' onBlur="comprobarVacio(this) && comprobarLongitud(this,'40') && comprobarTexto(this,'40') && comprobarAlfabetico(this,'40')" />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['participacion'];?>
						</th>
						<td class="formThTd"><input type="text" id="participacion" name="participacion" placeholder="<?php echo $strings['Escriba aqui...']?>" size = '5' value = '' onBlur="comprobarVacio(this) && comprobarLongitud(this,'3') && comprobarTexto(this,'3')" maxlength="3" />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['resguardo'];?>
						</th>
						<td class="formThTd"><input type="file" id="resguardo" name="resguardo" value='' size = '50'  onBlur="comprobarVacio(this) && comprobarLongitud(this','50')" maxlength="50"  required />
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['ingresado'];?>
						</th>
						<td class="formThTd">
							<select id="ingresado" name="ingresado" value=""onblur="comprobarVacio(this);">
								<option value="">
									<?php echo $strings['Elija opción'];?>
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
						<td class="formThTd"><input type="text" id="premiopersonal" name="premiopersonal" placeholder="<?php echo $strings['Escriba aqui...']?>" size = '6' value = '' onBlur="comprobarVacio(this) && comprobarLongitud(this,'6') && comprobarTexto(this,'6')" maxlength="6"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['pagado'];?>
						</th>
						<td class="formThTd">
							<select id="pagado" name="pagado" value="" onblur="comprobarVacio(this);">
								<option value="">
									<?php echo $strings['Elija opción'];?>
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
							<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
						<form action='../Controllers/LOTERIA_CONTROLLER.php' method="post" style="display: inline">
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