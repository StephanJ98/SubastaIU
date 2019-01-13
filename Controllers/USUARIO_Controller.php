<?php
/*
	Autor: GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Usuario
*/
session_start(); //solicito trabajar con la session
include '../Models/USUARIO_Model.php';
include '../Models/HISTORIAL_Model.php';
include '../Views/USUARIOS_ADD_View.php';
include '../Views/USUARIOS_DELETE_View.php';
include '../Views/USUARIOS_EDIT_View.php';
include '../Views/USUARIOS_SEARCH_View.php';
include '../Views/USUARIOS_SHOWALL_View.php';
include '../Views/USUARIOS_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() {
	$idUser = $_REQUEST[ 'idUser' ];
	$password = $_REQUEST[ 'password' ];
	$nombre = $_REQUEST[ 'nombre' ];
	$email = $_REQUEST[ 'email' ];
	$avatar = null;
	$rol = $_REQUEST[ 'rol' ];
	$action = $_REQUEST[ 'action' ];

	if ( isset( $_FILES[ 'avatar' ][ 'name' ] ) ) {
		$nombreAvatar = $_FILES[ 'avatar' ][ 'name' ];
	} else {
		$nombreAvatar = null;
	}
	if ( isset( $_FILES[ 'avatar' ][ 'tmp_name' ] ) ) {
		$nombreTempAvatar = $_FILES[ 'avatar' ][ 'tmp_name' ];
	} else {
		$nombreTempAvatar = null;
	}
	if ( $nombreAvatar != null ) {
		$dir_subida = '../Files/';
		$avatar = $dir_subida . $nombreAvatar;
		move_uploaded_file( $nombreTempAvatar, $avatar );
	}
	$USUARIO = new USUARIOS_Model(
		$idUser,
		$password,
		$nombre,
		$email,
		$avatar,
		$rol
	);
	
	return $USUARIO;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new USUARIOS_ADD();
		} else {
			$USUARIO = get_data_form();
			$respuesta = $USUARIO->ADD();
			new MESSAGE( $respuesta, '../Controllers/USUARIO_Controller.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$USUARIO = new USUARIOS_Model( $_REQUEST[ 'idUser' ], '', '', '', '', '');
			$valores = $USUARIO->RellenaDatos( $_REQUEST[ 'idUser' ] );
			new USUARIOS_DELETE( $valores );
		} else {
			$USUARIO = get_data_form();
			$respuesta = $USUARIO->DELETE();
			new MESSAGE( $respuesta, '../Controllers/USUARIO_Controller.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {
			$USUARIO = new USUARIOS_Model( $_REQUEST[ 'idUser' ], '', '', '', '', '');
			$valores = $USUARIO->RellenaDatos( $_REQUEST[ 'idUser' ] );
			new USUARIOS_EDIT( $valores );
		} else {
			$USUARIO = get_data_form();
			$respuesta = $USUARIO->EDIT();
			new MESSAGE( $respuesta, '../Controllers/USUARIO_Controller.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new USUARIOS_SEARCH();
		} else {
			$USUARIO = new USUARIOS_Model($_REQUEST['idUser'],$_REQUEST['nombre'],$_REQUEST['email'],'',$_REQUEST['rol'],'');
			$datos = $USUARIO->SEARCH();
			$lista = array( 'idUser', 'nombre', 'email', 'rol' );
			new USUARIOS_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$USUARIO = new USUARIOS_Model( $_REQUEST[ 'idUser' ], '', '', '', '', '');
		$valores = $USUARIO->RellenaDatos( $_REQUEST[ 'idUser' ] );
		new USUARIOS_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$USUARIO = new USUARIOS_Model( '', '', '', '', '', '');
		} else {
			$USUARIO = get_data_form();
		}
		$datos = $USUARIO->SEARCH();
		$lista = array( 'idUser', 'nombre', 'email', 'avatar', 'rol' );
		new USUARIOS_SHOWALL( $lista, $datos );
}
?>