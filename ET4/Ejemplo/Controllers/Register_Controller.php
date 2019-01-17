<?php
/*
	Archivo php
	Nombre: Register_Controller.php
	Autor: cvy3ms
	Fecha de creación: 23/11/2018 
	Función: controlador que realiza las operaciones necesarias para realizar un registro correcto de un nuevo usuario
*/
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

if(!isset($_POST['login'])){
	include '../Views/Register_View.php';
	$register = new Register();
}
else{
		
	include '../Models/USUARIOS_MODEL.php';
	
	
	$nombreFoto = $_FILES[ 'fotopersonal' ][ 'name' ];
	$nombreTempFoto = $_FILES[ 'fotopersonal' ][ 'tmp_name' ];
	$dir_subida = '../Files/';
	$fotopersonal = $dir_subida . $nombreFoto ;
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['DNI'],$_REQUEST['nombre'],$_REQUEST['apellidos'],
		$_REQUEST['telefono'],$_REQUEST['email'],$_REQUEST['FechaNacimiento'],$fotopersonal,$_REQUEST['sexo']);
	$respuesta = $usuario->Register();

	if ($respuesta == 'true'){
		$respuesta = $usuario->ADD();
		move_uploaded_file( $nombreTempFoto, $fotopersonal );
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{
		include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}

}

?>

