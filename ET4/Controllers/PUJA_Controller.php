<?php
/*
	Autor: 	GUI
	Fecha de creación: 01/01/2019 
	Función: controlador que realiza las acciones, recibidas de las vistas,relativas  a la clase Puja
*/
session_start(); //solicito trabajar con la session
include '../Models/HISTORIAL_Model.php';
include '../Models/PUJA_Model.php';
include '../Models/SUBASTA_Model.php';
include '../Views/PUJA_SEARCH_View.php';
include '../Views/PUJA_SHOWALL_View.php';
include '../Views/MESSAGE_View.php';

function get_data_form() { //en las vistas los id y name de los elemntos deben ser exactamente estos.
    $idPuja = $_REQUEST['idPuja'];
    $idSubasta = $_REQUEST['idSubasta'];
    $idUser = $_REQUEST['idUser'];
    $importe = $_REQUEST['importe'];
    $action = $_REQUEST[ 'action' ];

    $PUJA = new PUJA_Model(
    	$idPuja,
    	$idSubasta,
    	$idUser,
    	$importe);
	return $PUJA;
}

if ( !isset( $_REQUEST[ 'action' ] ) ) {
	$_REQUEST[ 'action' ] = '';
}
switch ( $_REQUEST[ 'action' ] ) {
	case 'ADD':
		if ( !$_POST ) {
			new PUJA_ADD();
		}
		else {
			$mayor = $_REQUEST['mayo'];
			$impor = $_REQUEST['importe'];
			if ($mayor > $impor) {
				new MESSAGE( 'La puja no es suficientemente alta', '../Controllers/PUJA_Controller.php' );
			}
			else{
				$HISTORIAL = new HISTORIAL_Model(time(),$_REQUEST['idSubasta'],$_REQUEST['idUser'],$_REQUEST['idPuja'],$impor);
				$HISTORIAL->ADD();
				$SUBASTA = new SUBASTA_Model($_REQUEST['idSubasta'],$_REQUEST['idUser'],$_REQUEST['producto'],$_REQUEST['info'],$_REQUEST['ficheroSubasta'],$_REQUEST['esCiega'],$impor);
				$SUBASTA->EDIT();
				$PUJA = get_data_form();
				$respuesta = $PUJA->ADD();
				new MESSAGE( $respuesta, '../Controllers/PUJA_Controller.php' );
			}
		}
		break;
	case 'DELETE':
		if ( !$_POST ) {
			$PUJA = new PUJA_Model( $_REQUEST['idPuja'],'','','' );
			$valores = $PUJA->RellenaDatos( $_REQUEST[ 'idPuja' ] );
			new PUJA_DELETE( $valores );
		} 
		else {
			$PUJA = get_data_form();
			$respuesta = $PUJA->DELETE();
			new MESSAGE( $respuesta, '../Controllers/PUJA_Controller.php' );
		}
		break;
	case 'EDIT':
		if ( !$_POST ) {

			$PUJA = new PUJA_Model( $_REQUEST['idPuja'],'','','' );
			$valores = $PUJA->RellenaDatos( $_REQUEST[ 'idPuja' ] );
			new PUJA_EDIT( $valores );
		} 
		else {

			$PUJA = get_data_form();
			$respuesta = $PUJA->EDIT();
			new MESSAGE( $respuesta, '../Controllers/PUJA_Controller.php' );
		}
		break;
	case 'SEARCH':
		if ( !$_POST ) {
			new PUJA_SEARCH();
		} 
		else {
			$PUJA = new PUJA_Model($_REQUEST['idPuja'],$_REQUEST['idSubasta'],$_REQUEST['idUser'],'');
			$datos = $PUJA->SEARCH();
			$lista = array( 'idPuja','idSubasta','idUser','importe');
			new PUJA_SHOWALL( $lista, $datos );
		}
		break;
	case 'SHOWCURRENT':
		$PUJA = new PUJA_Model( $_REQUEST['idPuja'],'','','');
		$valores = $PUJA->RellenaDatos( $_REQUEST[ 'idPuja' ] );
		new PUJA_SHOWCURRENT( $valores );
		break;
	default:
		if ( !$_POST ) {
			$PUJA = new PUJA_Model('','','','');
		} 
		else {
			$PUJA = new PUJA_Model($_REQUEST['idPuja'],$_REQUEST['idSubasta'],$_REQUEST['idUser'],$_REQUEST['importe']);
		}
		$datos = $PUJA->SEARCH();
		$lista = array( 'idPuja','idSubasta','idUser','importe');
		new PUJA_SHOWALL( $lista, $datos );
}
?>