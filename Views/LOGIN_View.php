<?php
//Crea-do el : 19-12-2018
//Creado por: Salva
class Login{
	function __construct(){	
		$this->render();
	}

	function render(){
		include 'Header.php'; 
?>			
	<h1>LOGIN</h1>
	<div id="forms">		
		<form name = 'Form' action='../Controllers/LOGIN_Controller.php' method='post' id="formularioLogin">
			Login : <input type = 'text'  name = 'login'  size = '10'  ><br>
			Paswordtraseña : <input type = 'password' name = 'password' id="password" value="" size = '10' ><br>
			<button>Sin función todavía</button> <!-- incluír acciones para confirmación -->
		</form>
	</div>	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							
<?php
	include 'Footer.php';
	} //fin metodo render
} //fin Login
?>
