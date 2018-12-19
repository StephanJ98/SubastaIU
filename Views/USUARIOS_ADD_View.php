<?php
    class USUARIOS_ADD {
        
     function __construct() {
		$this->render();
	}
    
    function render() {
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
    <div class="seccion">
			<h2>
				<?php echo $strings['Formulario de inserción'];?>
			</h2>
            <form name="ADDFORM" action="../Controllers/USUARIOS_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarAddForm()">
                <table>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre de Usuario'];?>
						</th>
						<td class="formThTd"><input type="text" id="idUser" name="idUsers" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="30" size="34" onBlur=" comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')""/">
					</tr>
                    <tr>
						<th class="formThTd">
							<?php echo $strings['Contraseña'];?>
						</th>
						<td class="formThTd"><input type="text" id="password" name="password" placeholder="<?php echo $strings['Escriba aqui...']?>" value="" maxlength="20" size="25" required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"/>
					</tr>
					<tr>
						<th class="formThTd">
							<?php echo $strings['Nombre y apellidos'];?>
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
						<td class="formThTd"><input type="text" id="userRol" name="userRol"  placeholder="<?php echo $strings['0, 1 o 2']?>" maxlength="1" size="1" onBlur="comprobarVacio(this) && comprobarLongitud(this,'1') && comprobarEntero(this,'0','3')"/>
					</tr>
                    <tr>
						<td colspan="2">
							<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="<?php echo $strings['Confirmar formulario']?>" /></button>
			</form>
						<form action='../Controllers/USUARIOS_CONTROLLER.php' method="post" style="display: inline">
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
                    