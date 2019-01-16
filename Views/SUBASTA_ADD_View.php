<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/1/2019 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
    class SUBASTA_ADD {
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
            <form name="ADDFORM" action="../Controllers/SUBASTA_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarAddForm()">
                <table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Identificador de Subasta'];?>
						</th>
						<td class="formThTd"><input type="text" id="idSubasta" name="idSubasta" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')""/">
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Producto'];?>
						</th>
						<td class="formThTd"><input type="text" id="producto" name="producto" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="50" size="50" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['info'];?>
						</th>
						<td class="formThTd"><input type="text" id="info" name="info" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="150" size = '154' value = '' onBlur="comprobarVacio(this) && comprobarLongitud(this,'150') && comprobarTexto(this,'150')" />
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Fichero'];?>
						</th>
						<td class="formThTd"><input type="file" id="ficheroSubasta" name="ficheroSubasta" value='' size = '50'  onBlur="comprobarVacio(this) && comprobarLongitud(this,'50')" maxlength="50"  required/>                                                     
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Ciega'];?>
						</th>
						<td class="formThTd">
								<select id="esCiega" name="esCiega" value="" required >
									<option value="">
										<?php echo $strings['Elija una opción']; ?>
									</option>
									<option value="true">
										<?php echo $strings['Si']; ?>
									</option>
									<option value="false">
										<?php echo $strings['No']; ?>
									</option>
								</select>
					</tr>
					<tr >
						<th class="formThTd">
							<?php echo $strings['Precio Base'];?>
						</th>
						<td class="formThTd"><input type="number" id="mayorPuja" name="mayorPuja" value = '0' maxlength="15" />
					</tr>
                    <tr>
						<td colspan="2">
							<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
						<form action='../Controllers/SUBASTA_Controller.php' method="post" style="display: inline">
							<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras']?>" /></button>
						</form>
					</tr>
				</table>
		</div>
		<br>
		<br>
<?php
		include '../Views/Footer.php';
		}
		}
?>
                    