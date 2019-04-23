<?php
/*
	Autor: GUI
	Fecha de creación: 01/01/2019 
	Función: contmensajeador que realiza las acciones, recibidas de las vistas,relativas  a la clase Notificacion
*/
session_start(); //solicito trabajar con la session
include '../Models/NOTIFICACION_Model.php';
include '../Views/NOTIFICACION_ADD_View.php';
include '../Views/NOTIFICACION_DELETE_View.php';
include '../Views/NOTIFICACION_EDIT_View.php';
include '../Views/NOTIFICACION_SEARCH_View.php';
include '../Views/NOTIFICACION_SHOWALL_View.php';
include '../Views/NOTIFICACION_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() {
	$idNotificacion = $_REQUEST[ 'idNotificacion' ];
	$fecha = $_REQUEST[ 'fecha' ];
	$idUser = $_REQUEST[ 'idUser' ];
	$mensaje = $_REQUEST[ 'mensaje' ];
	$action = $_REQUEST[ 'action' ];

	$NOTIFICACION = new NOTIFICACION_Model(
		$idNotificacion,
		$fecha,
		$idUser,
		$mensaje
	);
	return $NOTIFICACION;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new NOTIFICACION_ADD();
		} else {
			$NOTIFICACION = get_data_form();
			$respuesta = $NOTIFICACION->ADD();
			new MESSAGE( $respuesta, '../Controllers/NOTIFICACION_Controller.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$NOTIFICACION = new NOTIFICACION_Model( $_REQUEST[ 'idNotificacion' ], '', '', '');
			$valores = $NOTIFICACION->RellenaDatos( $_REQUEST[ 'idNotificacion' ] );
			new NOTIFICACION_DELETE( $valores );
		} else {
			$NOTIFICACION = get_data_form();
			$respuesta = $NOTIFICACION->DELETE();
			new MESSAGE( $respuesta, '../Controllers/NOTIFICACION_Controller.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$NOTIFICACION = new NOTIFICACION_Model( $_REQUEST[ 'idNotificacion' ], '', '', '');
			$valores = $NOTIFICACION->RellenaDatos( $_REQUEST[ 'idNotificacion' ] );
			new NOTIFICACION_EDIT( $valores );
		} else {

			$NOTIFICACION = get_data_form();
			$respuesta = $NOTIFICACION->EDIT();
			new MESSAGE( $respuesta, '../Controllers/NOTIFICACION_Controller.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new NOTIFICACION_SEARCH();
		} else {
			$NOTIFICACION = get_data_form();
			$datos = $NOTIFICACION->SEARCH();
			$lista = array( 'idNotificacion', 'fecha', 'idUser', 'mensaje' );
			new NOTIFICACION_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$NOTIFICACION = new NOTIFICACION_Model( $_REQUEST[ 'idNotificacion' ], '', '', '');
		$valores = $NOTIFICACION->RellenaDatos( $_REQUEST[ 'idNotificacion' ] );
		new NOTIFICACION_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$NOTIFICACION = new NOTIFICACION_Model( $_REQUEST[ 'idNotificacion' ], '', '', '');
		} else {
			$NOTIFICACION = get_data_form();
		}
		$datos = $NOTIFICACION->SEARCH();
		$lista = array( 'idNotificacion', 'fecha', 'idUser', 'mensaje' );
		new NOTIFICACION_SHOWALL( $lista, $datos );
}
?>