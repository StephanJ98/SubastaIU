<?php
/*
	Autor: 	GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Subastas
*/
session_start(); //solicito trabajar con la session
include '../Models/SUBASTA_Model.php';
include '../Views/SUBASTA_ADD_View.php';
include '../Views/SUBASTA_DELETE_View.php';
include '../Views/SUBASTA_EDIT_View.php';
include '../Views/SUBASTA_SEARCH_View.php';
include '../Views/SUBASTA_SHOWALL_View.php';
include '../Views/SUBASTA_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() { //en las vistas los id y name de los elemntos deben ser exactamente estos.
    $idSubasta = $_REQUEST['idSubasta'];
    $producto = $_REQUEST['producto'];
    $info = $_REQUEST['info'];
    $ficheroSubasta = null;
    $esCiega = $_REQUEST['esCiega'];
    $mayorPuja = $_REQUEST['mayorPuja'];
    $action = $_REQUEST[ 'action' ];//Variable a incluir en las vistas ( ver ejemplo)

	if ( isset( $_FILES[ 'ficheroSubasta' ][ 'name' ] ) ) {
		$productoFicheroSubasta = $_FILES[ 'ficheroSubasta' ][ 'name' ];
	} 
	else {
		$productoFicheroSubasta = null;
	}
	if ( isset( $_FILES[ 'ficheroSubasta' ][ 'tmp_name' ] ) ) {
		$productoTempFicheroSubasta = $_FILES[ 'ficheroSubasta' ][ 'tmp_name' ];
	} 
	else {
		$productoTempFicheroSubasta = null;
	}
	if ( $productoFicheroSubasta != null ) {
		$dir_subida = '../Files/';
		$ficheroSubasta = $dir_subida . $productoFicheroSubasta;
		move_uploaded_file( $productoTempFicheroSubasta, $ficheroSubasta );
	}
	$action = $_REQUEST[ 'action' ];
    $SUBASTA = new SUBASTA_Model($idSubasta,$producto,$info,$ficheroSubasta,$esCiega,$mayorPuja);
	return $SUBASTA;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new SUBASTA_ADD();
		}
		else {
			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->ADD();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_CONTROLLER.php' );
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','','','' );
			$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
			new SUBASTA_DELETE( $valores );
		} 
		else {
			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->DELETE();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_CONTROLLER.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','','','' );
			$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
			new SUBASTA_EDIT( $valores );
		} 
		else {

			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->EDIT();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_CONTROLLER.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new SUBASTA_SEARCH();
		} 
		else {
			$SUBASTA = new SUBASTA_Model($_REQUEST['idSubasta'],$_REQUEST['producto'],$_REQUEST['info'],'',$_REQUEST['esCiega'],$_REQUEST['mayorPuja']);
			$datos = $SUBASTA->SEARCH();
			$lista = array( 'idSubasta','producto','info','esCiega','mayorPuja');
			new SUBASTA_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','');
		$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
		new SUBASTA_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$SUBASTA = new SUBASTA_Model( '','','','','','');
		} 
		else {
			$SUBASTA = get_data_form();
		}
		$datos = $SUBASTA->SEARCH();
		$lista = array( 'idSubasta','producto','info','esCiega','mayorPuja');
		new SUBASTA_SHOWALL( $lista, $datos );
}

?>