<?php
/*
	Autor: 	GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que gestiona la logica de subasta
*/

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