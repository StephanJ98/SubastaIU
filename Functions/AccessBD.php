<?php
/*
	Autor: 	GUI
	Fecha de creación: 11/12/2018 
	Función: Realiza la conexión a la base de datos. Es el único lugar donde se definen los parametros de conexión a la bd
*/
function ConectarBD()
	{
	    $mysqli = new mysqli("localhost", "GUIBD", "passGUIBD", "GUIBD"); //maquina, user, pass, bd
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			return false;
		}
		return $mysqli;
	}
?>