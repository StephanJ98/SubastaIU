<?php
/*  Archivo php
	Nombre: LOTERIA_SEARCH_View.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: vista de el formulario de búsqueda(search) realizada con una clase donde se muestran todos los campos a rellenar para buscar a un usuario e la base de datos
*/
class LOTERIA_SEARCH {

	function __construct() {
		$this->render();
	}

	function render() {

		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Formulario de búsqueda'];?>
			</h2>
			<form id="SEARCHLOT" action="../Controllers/LOTERIA_CONTROLLER.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarSearchLot()">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" size="60" onblur="comprobarLongitud(this,'60') && comprobarTexto(this,'60')" maxlength="60"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['nombre'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur="comprobarLongitud(this,'30') && comprobarTexto(this,'30') && comprobarAlfabetico(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Apellidos'];?>
						</th>
						<td class="formThTd"><input type="text" id="apellidos" name="apellidos" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="40" size="40" onblur="comprobarLongitud(this,'40') && comprobarTexto(this,'40') && comprobarAlfabetico(this,'40')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['participacion'];?>
						</th>
						<td class="formThTd"><input type="text" id="participacion" name="participacion" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="3" size="3" onBlur="comprobarLongitud(this,'3') && comprobarTexto(this,'3')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['ingresado'];?>
						</th>
						<td class="formThTd">
							<select id="ingresado" name="ingresado" value="">
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
						<td class="formThTd"><input type="text" id="premiopersonal" name="premiopersonal" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="6" size="6" onBlur="comprobarLongitud(this,'6') "/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['pagado'];?>
						</th>
						<td class="formThTd">
							<select id="pagado" name="pagado" value="">
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
							<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="<?php echo $strings['Buscar formulario']?>" /></button>
			</form>
						<form action='../Controllers/LOTERIA_CONTROLLER.php' method="post" style="display:inline">
							<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
						</form>
						</td>
					</tr>
				</table>

		</div>
<?php
		include '../Views/Footer.php';
		}
		}
?>