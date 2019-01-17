<?php
class SUBASTA_EDIT {

	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}

	function render( $valores ) {
		$this->valores = $valores;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
		?>
		<div class="container seccion">
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Formulario de modificación'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<form name="EDIT" action="../Controllers/SUBASTA_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarEdit()">
					<table>
						<tr>
							<th class="formThTd">
								<?php echo $strings['IdSubasta'];?>
							</th>
							<td class="formThTd"><input type="text" id="idSubasta" name="idSubasta" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['idSubasta']?>" maxlength="30" size="34"  readonly onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')" required/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Identificador de Usuario'];?>
							</th>
							<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['idUser']?>" maxlength="30" size="34"  readonly onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')" required/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Producto'];?>
							</th>
							<td class="formThTd"><input type="text" id="producto" name="producto" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['producto']?>" maxlength="128" size="128" onBlur="comprobarVacio(this) && comprobarLongitud(this,128) && comprobarTexto(this,128)" required/>
						</tr>
						<tr>
							<th class="formThTd">
								<?php echo $strings['Info'];?>
							</th>
							<td class="formThTd"><input type="text" id="info" name="info" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['info']?>" maxlength="150" size="154" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'150') && comprobarTexto(this,'150') && comprobarAlfabetico(this,'150')"/>
						</tr>
	                    <tr>
							<th class="formThTd">
								<?php echo $strings['Es Ciega'];?>
							</th>
							<td class="formThTd"><input type="text" id="esCiega" name="esCiega" placeholder="<?php echo $strings['Escriba aqui...']?>" value="<?php echo $this->valores['esCiega']?>" maxlength="60" size="70" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)" required/>
						</tr>
	                    <tr>
							<th class="formThTd">
								<?php echo $strings['Fichero'];?>
							</th>
							<td class="formThTd">
								<a href="<?php echo $this->valores['ficheroSubasta']?>" alt="<?php echo $strings['ficheroSubasta'];?>">
									<?php echo $this->valores['ficheroSubasta']?></a>
								<p style="font-size: 12px"><?php echo $strings['Seleccione una nueva foto personal si desea cambiarla, en caso contrario, no es necesario seleccionarla de nuevo.'];?></p>
						
								<input type="file" id="ficheroSubasta" name="ficheroSubasta" value="<?php echo $this->valores['ficheroSubasta']?>" accept="image/*"  />
						</tr>
						<?php
						if ($_SESSION['rol'] == 0) {
							?>
							<tr>
							<th class="formThTd">
								<?php echo $strings['Mayor Puja'];?>
							</th>
							<td class="formThTd"><input type="text" id="mayorPuja" name="mayorPuja"  value="<?php echo $this->valores['mayorPuja']?>" maxlength="1" size="1" onBlur="comprobarVacio(this) && comprobarLongitud(this,'1') && comprobarEntero(this,'0','3')"/>
							</tr>
						<?php
						}
						?>
	                    <tr>
							<td colspan="2">
								<button type="submit" name="action" value="EDIT"><img src="../Views/icon/modificar.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
							</tr>
					</table>
				</form>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/SUBASTA_Controller.php' style="display: inline">
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