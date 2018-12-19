<?php
/*
	Archivo php
	Nombre: USUARIOS_CONTROLLER.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: controlador que realiza las acciones, recibidas de las vistas, necesarias para realizar altas, bajas, modificaciones y búsquedas.
*/
session_start(); //solicito trabajar con la session

include '../Models/USUARIOS_MODEL.php';
include '../Views/USUARIOS_SHOWALL_View.php';
include '../Views/USUARIOS_SEARCH_View.php';
include '../Views/USUARIOS_ADD_View.php';
include '../Views/USUARIOS_EDIT_View.php';
include '../Views/USUARIOS_DELETE_View.php';
include '../Views/USUARIOS_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';


function get_data_form() {

	$login = $_REQUEST[ 'login' ];
	$password = $_REQUEST[ 'password' ];
	$DNI = $_REQUEST[ 'DNI' ];
	$nombre = $_REQUEST[ 'nombre' ];
	$apellidos = $_REQUEST[ 'apellidos' ];
	$telefono = $_REQUEST[ 'telefono' ];
	$email = $_REQUEST[ 'email' ];
	$FechaNacimiento = $_REQUEST[ 'FechaNacimiento' ];
	$sexo = $_REQUEST[ 'sexo' ];
	$fotopersonal = null;
	$action = $_REQUEST[ 'action' ];

	if ( isset( $_FILES[ 'fotopersonal' ][ 'name' ] ) ) {
		$nombreFoto = $_FILES[ 'fotopersonal' ][ 'name' ];
	} else {
		$nombreFoto = null;
	}

	if ( isset( $_FILES[ 'fotopersonal' ][ 'tmp_name' ] ) ) {
		$nombreTempFoto = $_FILES[ 'fotopersonal' ][ 'tmp_name' ];
	} else {
		$nombreTempFoto = null;
	}


	if ( $nombreFoto != null ) {
		$dir_subida = '../Files/';
		$fotopersonal = $dir_subida . $nombreFoto;
		move_uploaded_file( $nombreTempFoto, $fotopersonal );
	}

	$USUARIOS = new USUARIOS_Model(
		$login,
		$password,
		$DNI,
		$nombre,
		$apellidos,
		$telefono,
		$email,
		$FechaNacimiento,
		$fotopersonal,
		$sexo
	);

	return $USUARIOS;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}

switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new USUARIOS_ADD();
		} else {
			$USUARIOS = get_data_form();
			$respuesta = $USUARIOS->ADD();
			new MESSAGE( $respuesta, '../Controllers/USUARIOS_CONTROLLER.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$USUARIOS = new USUARIOS_Model( $_REQUEST[ 'login' ], '', '', '', '', '', '', '', '', '' );
			$valores = $USUARIOS->RellenaDatos( $_REQUEST[ 'login' ] );
			new USUARIOS_DELETE( $valores );
		} else {
			$USUARIOS = get_data_form();
			$respuesta = $USUARIOS->DELETE();
			new MESSAGE( $respuesta, '../Controllers/USUARIOS_CONTROLLER.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$USUARIOS = new USUARIOS_Model( $_REQUEST[ 'login' ], '', '', '', '', '', '', '', '', '' );
			$valores = $USUARIOS->RellenaDatos( $_REQUEST[ 'login' ] );
			new USUARIOS_EDIT( $valores );
		} else {

			$USUARIOS = get_data_form();
			$respuesta = $USUARIOS->EDIT();
			new MESSAGE( $respuesta, '../Controllers/USUARIOS_CONTROLLER.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new USUARIOS_SEARCH();
		} else {
			$USUARIOS = get_data_form();
			$datos = $USUARIOS->SEARCH();
			$lista = array( 'login', 'DNI', 'telefono', 'email', 'FechaNacimiento', 'fotopersonal', 'sexo' );
			new USUARIOS_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$USUARIOS = new USUARIOS_Model( $_REQUEST[ 'login' ], '', '', '', '', '', '', '', '', '' );
		$valores = $USUARIOS->RellenaDatos( $_REQUEST[ 'login' ] );
		new USUARIOS_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$USUARIOS = new USUARIOS_Model( '', '', '', '', '', '', '', '', '', '' );
		} else {
			$USUARIOS = get_data_form();
		}
		$datos = $USUARIOS->SEARCH();
		$lista = array( 'login', 'DNI', 'telefono', 'email', 'FechaNacimiento', 'fotopersonal', 'sexo' );
		new USUARIOS_SHOWALL( $lista, $datos );
}

?>