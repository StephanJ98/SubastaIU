<?php
/*
	Autor: GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que realiza las operaciones necesarias para realizar un registro correcto de un nuevo usuario
*/
session_start();
include_once '../Locales/'.$_SESSION['idioma'].'.php';

if(!isset($_POST['idUser'])){
	include '../Views/REGISTER_View.php';
	$register = new Register();
}
else{	
	include '../Models/USUARIO_Model.php';
	$nombreFoto = $_FILES[ 'nombreFoto' ][ 'name' ];
	$nombreTempAvatar = $_FILES[ 'nombreFoto' ][ 'tmp_name' ];
	$dir_subida = '../Files/';
	$avatar = $dir_subida . $nombreFoto ;

	$usuario = new USUARIOS_Model($_REQUEST['idUser'],$_REQUEST['password'],$_REQUEST['nombre'],$_REQUEST['email'],$avatar,$_REQUEST['rol']);
	$respuesta = $usuario->Register();

	if ($respuesta == 'true'){
		$respuesta = $usuario->ADD();
		move_uploaded_file( $nombreTempAvatar, $avatar );
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, './LOGIN_Controller.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, './LOGIN_Controller.php');
	}
}
?>