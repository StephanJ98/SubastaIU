<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del footer
*/
    class PUJA_SEARCH { 
     function __construct() {
		$this->render();
	}
    
    function render() {
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>

<div class="seccion">
		<h2>
			<?php echo $strings['Formulario de búsqueda de pujas'];?>
		</h2>
		<form id="SEARCHPUJA" action="../Controllers/PUJA_Controller.php" method="post" onsubmit="return comprobarSearchLot()">
			<table>
				<tr>
					<th class="formThTd">
						<?php echo $strings['Id de Usuario'];?>
					</th>
					<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onblur="comprobarLongitud(this,'30') && comprobarTexto(this,'30') && comprobarAlfabetico(this,'30')"/>
				</tr>
				<tr>
					<th class="formThTd">
						<?php echo $strings['Id de Subasta'];?>
					</th>
					<td class="formThTd"><input type="text" id="idSubasta" name="idSubasta" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="30" onblur="comprobarLongitud(this,'30') && comprobarTexto(this,'30') && comprobarAlfabetico(this,'30')"/>
				</tr>
				<tr>
					<th class="formThTd">
						<?php echo $strings['importe'];?>
					</th>
					<td class="formThTd"><input type="text" id="importe" name="importe" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="3" size="3" onblur="comprobarLongitud(this,'3') && comprobarTexto(this,'3')"/>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" name="action" value="SEARCH"><img src="../Views/icon/buscar.png" alt="<?php echo $strings['Buscar formulario']?>" /></button>
		</form>
					<form action='../Controllers/PUJA_Controller.php' method="post" style="display:inline">
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