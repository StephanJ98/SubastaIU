<?php
/*
	Autor: 	GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Subastas
*/
session_start(); //solicito trabajar con la session
include '../Models/LOTERIA_MODEL.php';
include '../Views/LOTERIA_SHOWALL_View.php';
include '../Views/LOTERIA_SEARCH_View.php';
include '../Views/LOTERIA_ADD_View.php';
include '../Views/LOTERIA_EDIT_View.php';
include '../Views/LOTERIA_DELETE_View.php';
include '../Views/LOTERIA_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() {
    $email = $_REQUEST['email'];
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $participacion = $_REQUEST['participacion'];
    $ingresado = $_REQUEST['ingresado'];
    $premiopersonal = $_REQUEST['premiopersonal'];
	$resguardo = null;
    $pagado = $_REQUEST['pagado'];

	if ( isset( $_FILES[ 'resguardo' ][ 'name' ] ) ) {
		$nombreFoto = $_FILES[ 'resguardo' ][ 'name' ];
	} 
	else {
		$nombreFoto = null;
	}
	if ( isset( $_FILES[ 'resguardo' ][ 'tmp_name' ] ) ) {
		$nombreTempFoto = $_FILES[ 'resguardo' ][ 'tmp_name' ];
	} 
	else {
		$nombreTempFoto = null;
	}
	if ( $nombreFoto != null ) {
		$dir_subida = '../Files/';
		$resguardo = $dir_subida . $nombreFoto;
		move_uploaded_file( $nombreTempFoto, $resguardo );
	}
	$action = $_REQUEST[ 'action' ];
    $LOTERIA = new LOTERIA_Model($email,$nombre,$apellidos,$participacion,$resguardo,$ingresado,$premiopersonal,$pagado);
	return $LOTERIA;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new LOTERIA_ADD();
		}
		else {
			$LOTERIA = get_data_form();
			$respuesta = $LOTERIA->ADD();
			new MESSAGE( $respuesta, '../Controllers/LOTERIA_CONTROLLER.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$LOTERIA = new LOTERIA_Model( $_REQUEST['email'],'','','','','','','' );
			$valores = $LOTERIA->RellenaDatos( $_REQUEST[ 'email' ] );
			new LOTERIA_DELETE( $valores );
		} 
		else {
			$LOTERIA = get_data_form();
			$respuesta = $LOTERIA->DELETE();
			new MESSAGE( $respuesta, '../Controllers/LOTERIA_CONTROLLER.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$LOTERIA = new LOTERIA_Model( $_REQUEST['email'],'','','','','','','' );
			$valores = $LOTERIA->RellenaDatos( $_REQUEST[ 'email' ] );
			new LOTERIA_EDIT( $valores );
		} 
		else {

			$LOTERIA = get_data_form();
			$respuesta = $LOTERIA->EDIT();
			new MESSAGE( $respuesta, '../Controllers/LOTERIA_CONTROLLER.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new LOTERIA_SEARCH();
		} 
		else {
			$LOTERIA = new LOTERIA_Model($_REQUEST['email'],$_REQUEST['nombre'],$_REQUEST['apellidos'],$_REQUEST['participacion'],'',$_REQUEST['ingresado'],$_REQUEST['premiopersonal'], $_REQUEST['pagado'] );
			$datos = $LOTERIA->SEARCH();
			$lista = array('email','nombre','apellidos','ingresado','pagado');
			new LOTERIA_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$LOTERIA = new LOTERIA_Model( $_REQUEST['email'],'','','','','','','' );
		$valores = $LOTERIA->RellenaDatos( $_REQUEST[ 'email' ] );
		new LOTERIA_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$LOTERIA = new LOTERIA_Model( '','','','','','','','' );
		} 
		else {
			$LOTERIA = get_data_form();
		}
		$datos = $LOTERIA->SEARCH();
		$lista = array( 'email','nombre','apellidos','ingresado','pagado');
		new LOTERIA_SHOWALL( $lista, $datos );
}

?>