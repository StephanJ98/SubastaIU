<?php
//Creado el : 19-12-2018
//Creado por: Salva

session_start();
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/Login_View.php';
	$login = new Login();
}
else{

	include '../Functions/AccessDB.php';

	include '../Models/USUARIO_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		header('Location:../index.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, 'Login_Controller.php');
	}

}

?>