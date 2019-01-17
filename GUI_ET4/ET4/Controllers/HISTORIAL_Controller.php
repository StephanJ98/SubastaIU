<?php
/*
	Autor: GUI
	Fecha de creación: 01/01/2019 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Historial
*/
session_start(); //solicito trabajar con la session
include '../Models/HISTORIAL_Model.php';
include '../Views/HISTORIAL_View.php';
include '../Views/HISTORIAL_SEARCH_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() {
	$idHistorial = $_REQUEST[ 'idHistorial' ];
	$idSubasta = $_REQUEST[ 'idSubasta' ];
	$idUser = $_REQUEST[ 'idUser' ];
	$idPuja = $_REQUEST[ 'idPuja' ];
	$importe = $_REQUEST[ 'importe' ];
	$action = $_REQUEST[ 'action' ];

	$HISTORIAL = new HISTORIAL_Model(
		$idHistorial,
		$idSubasta,
		$idUser,
		$idPuja,
		$importe
	);
	return $HISTORIAL;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new HISTORIAL_ADD();
		} else {
			$HISTORIAL = get_data_form();
			$respuesta = $HISTORIAL->ADD();
			new MESSAGE( $respuesta, '../Controllers/HISTORIAL_Controller.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$HISTORIAL = new HISTORIAL_Model( $_REQUEST[ 'idHistorial' ], '', '', '', '');
			$valores = $HISTORIAL->RellenaDatos( $_REQUEST[ 'idHistorial' ] );
			new HISTORIAL_DELETE( $valores );
		} else {
			$HISTORIAL = get_data_form();
			$respuesta = $HISTORIAL->DELETE();
			new MESSAGE( $respuesta, '../Controllers/HISTORIAL_Controller.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$HISTORIAL = new HISTORIAL_Model( $_REQUEST[ 'idHistorial' ], '', '', '', '');
			$valores = $HISTORIAL->RellenaDatos( $_REQUEST[ 'idHistorial' ] );
			new HISTORIAL_EDIT( $valores );
		} else {

			$HISTORIAL = get_data_form();
			$respuesta = $HISTORIAL->EDIT();
			new MESSAGE( $respuesta, '../Controllers/HISTORIAL_Controller.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new HISTORIAL_SEARCH();
		} else {
			$HISTORIAL = get_data_form();
			$datos = $HISTORIAL->SEARCH();
			$lista = array( 'idHistorial', 'idSubasta', 'idUser', 'idPuja', 'importe' );
			new HISTORIAL_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$HISTORIAL = new HISTORIAL_Model( $_REQUEST[ 'idHistorial' ], '', '', '', '');
		$valores = $HISTORIAL->RellenaDatos( $_REQUEST[ 'idHistorial' ] );
		new HISTORIAL_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$HISTORIAL = new HISTORIAL_Model( '', '', '', '', '');
		} else {
			$HISTORIAL = get_data_form();
		}
		$datos = $HISTORIAL->SEARCH();
		$lista = array( 'idHistorial', 'idSubasta', 'idUser', 'idPuja', 'importe' );
		new HISTORIAL_SHOWALL( $lista, $datos );
}
?>