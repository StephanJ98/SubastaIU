<?php

/*	Archivo php
	Nombre: Authentication.php
	Autor:	cvy3ms
	Fecha de creaci�n: 19/11/2018 
	Funci�n: Esta funci�n valida si existe la variable de session login. Si no existe redirige a la pagina de login.
			Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador.
*/
function IsAuthenticated(){

	if (!isset($_SESSION['login'])){
		return false;
	}
	else{
		return true;
	}

} //end of function IsAuthenticated()
?>