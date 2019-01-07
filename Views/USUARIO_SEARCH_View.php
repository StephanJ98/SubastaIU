<?php
class USUARIO_SEARCH {

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
			<form id="SEARCH" action="../Controllers/USUARIO_CONTROLLER.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarSearch()">
				<table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre de Usuario'];?>
						</th>
						<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur="comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña'];?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="128" size="132" onBlur="comprobarLongitud(this,'128') && comprobarTexto(this,'128')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre y apellidos'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="150" size="154" onBlur="comprobarLongitud(this,'150') && comprobarTexto(this,'150') && comprobarAlfabetico(this,'30')"/>
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="60" size="70" onBlur="comprobarLongitud(this,'60') && comprobarTexto(this,'60')"/>
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Avatar'];?>
						</th>
						<td class="formThTd"><input type="file" id="avatar" name="avatar" value="" accept="image/*"/>
					</tr>
					<tr>
                        <th class="formThTd">
                            <?php echo $strings['Rol'];?>
                        </th>
                        <td class="formThTd"><input type="text" id="userRol" name="userRol" placeholder="<?php echo $strings['0, 1 o 2']?>" maxlength="1" size="1" onBlur="comprobarLongitud(this,'1') && comprobarEntero(this,'0','3')"/>
                    </tr>
                    <tr>
						<td colspan="2">
							<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="<?php echo $strings['Buscar formulario']?>" /></button>
			</form>
						<form action='../Controllers/USUARIO_CONTROLLER.php' method="post" style="display:inline">
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