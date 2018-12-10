<?php
/*  Archivo php
	Nombre: Login_View.php
	Autor: 	cvy3ms
	Fecha de creación: 23/11/20178
	Función: vista de logearse(login) realizada con una clase donde se muestran los campos necesarios para logearse en nuestra aplicación
*/
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

					<td class="formThTd"><input type='text' id="login" name='login' placeholder="<?php echo $strings['Escriba aqui...'] ?>" maxlength='15' size='15' value='' required onBlur="comprobarVacio(this) && comprobarLongitud(this,'15') && comprobarTexto(this,'15')"><br>
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