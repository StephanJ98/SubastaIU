<?php
//Crea-do el : 19-12-2018
//Creado por: Salva
class Login {

	function __construct() {
		$this->render();
	}

	function render() {

		include '../Views/Header.php';
		?>

		<h1>
			<?php echo  $strings['Login']; ?>
		</h1>
		<form name='Form' action='../Controllers/Login_Controller.php' method='post' onsubmit="return comprobarLogin()">
			<table>
				<tr>
					<th class="formThTd">
						<?php echo $strings['Usuario'];?>: </th>

					<td class="formThTd"><input type='text' id="idUser" name='idUser' placeholder="<?php echo $strings['Escriba aqui...'] ?>" maxlength='30' size='30' value='' required onBlur="comprobarVacio(this) && comprobarLongitud(this,'30') && comprobarTexto(this,'30')"><br>
				</tr>
				<tr>
					<th class="formThTd">
						<?php echo $strings['Contraseña'];?>: </th>
					<td class="formThTd"><input type='password' id="password" name='password' placeholder="<?php echo $strings['Escriba aqui...'] ?>" maxlength='20' size='20' value='' required onBlur="comprobarVacio(this) && comprobarLongitud(this,'20') && comprobarTexto(this,'20')"><br>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" name="action" value="Login"><img src="../Views/icon/conectarse.png" alt="<?php echo $strings['Conectarse'] ?>" /></button>
				</tr>
			</table>
		</form>

<?php
		include '../Views/Footer.php';
	} //fin metodo render

	} //fin Login

?>