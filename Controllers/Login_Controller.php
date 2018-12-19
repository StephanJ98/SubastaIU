<?php
//Creado el : 19-12-2018
//Creado por: Salva

session_start();
if(!isset($_REQUEST['idUser']) && !(isset($_REQUEST['password']))){
	include '../Views/Login_View.php';
	$login = new Login();
}
else{

	include '../Functions/AccessDB.php';

	include '../Models/USUARIO_Model.php';
	$usuario = new USUARIO_Model($_REQUEST['idUser'],$_REQUEST['password'],'','','','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true'){
		session_start();
		$_SESSION['idUser'] = $_REQUEST['idUser'];
		header('Location:../index.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, 'LOGIN_Controller.php');
	}

}

?>