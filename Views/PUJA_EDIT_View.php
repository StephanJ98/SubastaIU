<?php
class PUJA_EDIT {

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
				<?php echo $strings['Formulario de modificación de Puja'];?>
			</h2>
            <form name="ADDFORM" action="../Controllers/PUJA_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarEDITForm()">
                <table>
					<tr>
						<th class="FormularioPujaEdit">
							<?php echo $strings['Nombre de PUJA'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="idPuja" name="idPujas" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
                    <tr>
						<th class="FormularioPujaEdit">
						<?php echo $strings['Id Subasta'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="id_Subasta" name="idPujas" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
                    <tr>
						<th class="FormularioPujaEdit">
							<?php echo $strings['Nombre de Usuario'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="idUser" name="idPujas" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
					</tr>
                    <tr>
                    <tr>
						<th class="FormularioPujaEdit">
							<?php echo $strings['Importe'];?>
						</th>
						<td class="Form_ADD_PUJA"><input type="text" id="ImportePuja" name="idPujas" placeholder="<?php echo $strings['Escriba aqui...']?>"value="" maxlength="30" size="34" >
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