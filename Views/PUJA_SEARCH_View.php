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
<div class="container-fluid seccion">
		<h2>
			<?php echo $strings['Formulario de búsqueda de Pujas'];?>
		</h2>
		<form id="SEARCHPUJA" action="../Controllers/PUJA_Controller.php" method="post" onsubmit="return comprobarSearchLot()">
			<div>
				<select id="rol" name="rol" value="" required >
					<option value="">
						<p><?php echo $strings['Elija']; ?></p>
					</option>
					<option value="idUser">
						<p><?php echo $strings['IdUsuario'];?></p>
					</option>
					<option value="idSubasta">
						<p><?php echo $strings['IdSubasta'];?></p>
					</option>
				</select>
				<input type="text" id="SEARCHPUJA" name="SEARCHPUJA" placeholder="<?php echo $strings['Introduzca los datos']?>" value="" maxlength="30" size="34"/>
				<br>
				<button type="submit" name="action" value="SEARCH" ><img src="../Views/icon/buscar.png" alt="<?php echo $strings['Buscar formulario']?>" /></button>		
			</div>
		</form>
			<form action='../Controllers/PUJA_Controller.php' method="post" style="display:inline">
				<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
			</form>
		</div>
<?php
		include '../Views/Footer.php';
		}
	}
?>