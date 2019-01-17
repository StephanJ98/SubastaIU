<?php

/*
	Archivo php
	Nombre: BdAdmin.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: realiza la conexión a la base de datos. Es el único lugar donde se definen los parametros de conexión a la bd
*/
function ConectarBD() //declaración de funcion
	{
		// se ejecuta la función de conexión mysqli y se recoge el manejador
	    $mysqli = new mysqli("localhost", "IU2018", "pass2018", "IU2018"); //maquina, user, pass, bd
		// si hay error en la conexión se muestra el mensaje de error
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			return false;
		}
		// la función devuelve el manejador
		return $mysqli;
	}
?>