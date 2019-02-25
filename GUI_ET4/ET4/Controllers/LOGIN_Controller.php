<?php
/*
	Creado el: 19-12-2018
	Modificado el: 20/12/2018
	Creado por: Salva
*/
session_start();
if(!isset($_REQUEST['idUser']) && !(isset($_REQUEST['password']))) {
	include '../Views/LOGIN_View.php';
	$login = new Login();
}
else{
	include '../Functions/AccessBD.php';
	include '../Models/USUARIO_Model.php';
	
	$usuario = new USUARIOS_Model($_REQUEST['idUser'],$_REQUEST['password'],'','','','');
	$respuesta = $usuario->login();
	$tipo = new USUARIOS_Model($_REQUEST['idUser'],'','','','','');
	$datos = $tipo->Gestion();
	if ($respuesta == 'true'){
		session_start();
		$_SESSION['idUser'] = $_REQUEST['idUser'];
		$_SESSION['rol'] = $datos;
		header('Location:../Controllers/USUARIO_Controller.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, '../Controllers/LOGIN_Controller.php');
	}
}
?>
