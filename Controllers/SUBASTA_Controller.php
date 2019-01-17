<?php
/*
	Autor: 	GUI
	Fecha de creación: 20/12/2018 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Subasta
*/
session_start(); //solicito trabajar con la session
include '../Models/HISTORIAL_Model.php';
include '../Models/SUBASTA_Model.php';
include '../Views/SUBASTA_ADD_View.php';
include '../Views/SUBASTA_DELETE_View.php';
include '../Views/SUBASTA_EDIT_View.php';
include '../Views/SUBASTA_SEARCH_View.php';
include '../Views/SUBASTA_SHOWALL_View.php';
include '../Views/SUBASTA_SHOWCURRENT_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() { 
    $idSubasta = $_REQUEST['idSubasta'];
    $idUser = $_REQUEST['idUser'];
    $producto = $_REQUEST['producto'];
    $info = $_REQUEST['info'];
    $ficheroSubasta = null;
    $esCiega = $_REQUEST['esCiega'];
    $mayorPuja = $_REQUEST['mayorPuja'];
    $action = $_REQUEST[ 'action' ];

	if ( isset( $_FILES[ 'ficheroSubasta' ][ 'name' ] ) ) {
		$nombreFicheroSubasta = $_FILES[ 'ficheroSubasta' ][ 'name' ];
	} else {
		$nombreFicheroSubasta = null;
	}
	if ( isset( $_FILES[ 'ficheroSubasta' ][ 'tmp_name' ] ) ) {
		$nombreTempFicheroSubasta = $_FILES[ 'ficheroSubasta' ][ 'tmp_name' ];
	} else {
		$nombreTempFicheroSubasta = null;
	}
	if ( $nombreFicheroSubasta != null ) {
		$dir_subida = '../Files/';
		$ficheroSubasta = $dir_subida . $nombreFicheroSubasta;
		move_uploaded_file( $nombreTempFicheroSubasta, $ficheroSubasta );
	}
    $SUBASTA = new SUBASTA_Model(
    	$idSubasta,
    	$idUser,
    	$producto,
    	$info,
    	$ficheroSubasta,
    	$esCiega,
    	$mayorPuja
    );
	return $SUBASTA;
}
if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new SUBASTA_ADD();
		} else {
			$HISTORIAL = new HISTORIAL_Model(time(),$_REQUEST['idSubasta'],$_REQUEST['idUser'],'','');
			$HISTORIAL->ADD();
			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->ADD();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_Controller.php');
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','','' );
			$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
			new SUBASTA_DELETE( $valores );
		} 
		else {
			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->DELETE();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_Controller.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {
			$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','','' );
			$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
			new SUBASTA_EDIT( $valores );
		} 
		else {
			$SUBASTA = get_data_form();
			$respuesta = $SUBASTA->EDIT();
			new MESSAGE( $respuesta, '../Controllers/SUBASTA_Controller.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new SUBASTA_SEARCH();
		} 
		else {
			$SUBASTA = new SUBASTA_Model($_REQUEST['idSubasta'],$_REQUEST['idUser'],$_REQUEST['producto'],$_REQUEST['info'],'',$_REQUEST['esCiega'],'');
			$datos = $SUBASTA->SEARCH();
			$lista = array( 'idSubasta','idUser','producto','info','esCiega');
			new SUBASTA_SHOWALL( $lista, $datos );
		}
		break;
	case 'SEARCHBIS':
		if ( !$_POST ) {
			new SUBASTA_SEARCH();
		} 
		else {
			$SUBASTA = new SUBASTA_Model($_REQUEST['idSubasta'],$_REQUEST['idUser'],$_REQUEST['producto'],$_REQUEST['info'],'',$_REQUEST['esCiega'],'');
			$datos = $SUBASTA->SEARCHBIS();
			$lista = array( 'idSubasta','idUser','producto','info','esCiega');
			new SUBASTA_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$SUBASTA = new SUBASTA_Model( $_REQUEST['idSubasta'],'','','','','','');
		$valores = $SUBASTA->RellenaDatos( $_REQUEST[ 'idSubasta' ] );
		new SUBASTA_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$SUBASTA = new SUBASTA_Model( '','','','','','','');
		} 
		else {
			$SUBASTA = get_data_form();
		}
		$datos = $SUBASTA->SEARCH();
		$lista = array( 'idSubasta','idUser','producto','info','esCiega','mayorPuja','ficheroSubasta');
		new SUBASTA_SHOWALL( $lista, $datos );
}
?>