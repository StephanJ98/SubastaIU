<?php
    class USUARIOS_ADD {
        
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
            <form name="ADDFORM" action="../Controllers/USUARIO_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarAddForm()">
                <table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre de Usuario'];?>
						</th>
						<td class="formThTd"><input type="text" id="idUser" name="idUser" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')""/">
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña'];?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="20" size="25" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre'];?>
						</th>
						<td class="formThTd"><input type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="150" size = '154' value = '' onBlur="comprobarVacio(this) && comprobarLongitud(this,'150') && comprobarTexto(this,'150')" />
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Correo electrónico'];?>
						</th>
						<td class="formThTd"><input type="text" id="email" name="email" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="60" size="64" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'60') && comprobarTexto(this,'60') && comprobarEmail(this)""/">
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Avatar'];?>
						</th>
						<td class="formThTd"><input type="file" id="avatar" name="avatar" value='' size = '50'  onBlur="comprobarVacio(this) && comprobarLongitud(this,'50')" maxlength="50"  required/>                                                                                                                                      
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Rol'];?>
						</th>
						<td class="formThTd">
								<select id="rol" name="rol" value="" required >
									<option value="">
										<?php echo $strings['Elija rol']; ?>
									</option>
									<option value="1">
										<?php echo $strings['Pujador']; ?>
									</option>
									<option value="2">
										<?php echo $strings['Subastador']; ?>
									</option>
									<option value="0">
										<?php echo $strings['Administrador']; ?>
									</option>
								</select>
					</tr>
                    <tr>
						<td colspan="2">
							<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
						<form action='../Controllers/USUARIO_Controller.php' method="post" style="display: inline">
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