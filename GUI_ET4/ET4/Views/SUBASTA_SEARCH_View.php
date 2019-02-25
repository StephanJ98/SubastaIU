<?php
class SUBASTA_SEARCH {

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
				<form id="SEARCHBIS" action="../Controllers/SUBASTA_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarSearch()">
					<table>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Identificador de Subasta'];?>
							</th>
							<td class="formThTd"><input type="text" id="idSubasta" name="idSubasta" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur="comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Identificador de Usuario'];?>
							</th>
							<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur="comprobarLongitud(this,'30') && comprobarTexto(this,'30')"/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Producto'];?>
							</th>
							<td class="formThTd"><input type="text" id="producto" name="producto" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="30" onBlur="comprobarLongitud(this,'150') && comprobarTexto(this,'150') && comprobarAlfabetico(this,'30')"/>
						</tr>
	                    <tr>
							<th class="formThTd">
								<?php echo $strings['Info'];?>
							</th>
							<td class="formThTd"><input type="text" id="info" name="info" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="60" size="70" onBlur="comprobarLongitud(this,'60') && comprobarTexto(this,'60')"/>
						</tr>
						<tr>
	                        <th class="formThTd">
	                            <?php echo $strings['Es Ciega'];?>
	                        </th>
	                        <td class="formThTd"><input type="text" id="esCiega" name="esCiega" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="7" size="7" />
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
				<form action='../Controllers/SUBASTA_Controller.php' method="post" style="display:inline">
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