<?php
/*
	Archivo php
	Nombre: Login_Controller.php
	Autor: cvy3ms
	Fecha 	fta875de creación: 23/11/2018 
	Función: controlador que realiza las operaciones necesarias para realizar un logeo correcto de un usuario
*/
session_start();
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/Login_View.php';
	$login = new Login();
}
else{

	include '../Functions/BdAdmin.php';

	include '../Models/USUARIOS_MODEL.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		header('Location:../Controllers/USUARIOS_CONTROLLER.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, '../Controllers/Login_Controller.php');
	}

}

?>

