<?php
    class PUJA_ADD {
        
     function __construct() {
		$this->render();
	}
    
    function render() {
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
    <div class="seccion">
			<h2>
				<?php echo $strings['Formulario de inserción'];?>
			</h2>
            <form name="ADDFORM" action="../Controllers/PUJA_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarAddForm()">
                <table>
				<tr>
						<th class="FormularioADDPuja">
						<?php echo $strings['Id Subasta'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="idSubasta" name="idSubasta" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
					<tr>
						<th class="FormularioADDPuja">
							<?php echo $strings['Nombre de PUJA'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="idPuja" name="idPuja" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
                 
                    <tr>
                    <tr>
						<th class="FormularioADDPuja">
							<?php echo $strings['IdUsuario'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
                    <tr>
						<th class="FormularioADDPuja">
							<?php echo $strings['importe'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="importe" name="importe" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
						<td colspan="2">
							<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
						<form action='../Controllers/PUJA_CONTROLLER.php' method="post" style="display: inline">
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
                    