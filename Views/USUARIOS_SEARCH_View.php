<?php
class USUARIOS_SEARCH {

	function __construct() {
		$this->render();
	}

	function render() {

		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="container seccion">
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Formulario de búsqueda'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<form id="SEARCH" action="../Controllers/USUARIO_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarSearch()">
					<table>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Nombre de Usuario'];?>
							</th>
							<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur="comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Nombre'];?>
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
	                            <?php echo $strings['Rol'];?>
	                        </th>
	                        <td class="formThTd"><input type="text" id="rol" name="rol" placeholder="<?php echo $strings['0(Admin), 1(Pujador) o 2(Subastador)']?>" maxlength="1" size="1" onBlur="comprobarLongitud(this,'1') && comprobarEntero(this,'0','3')"/>
	                    </tr>
	                    <tr>
							<td colspan="2">
								<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="<?php echo $strings['Buscar formulario']?>" /></button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/USUARIO_Controller.php' method="post" style="display:inline">
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