<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class NOTIFICACION_Model { //declaración de la clase

	var $idNotificacion; // declaración del atributo idNotificacion
	var $mensaje; // declaración del atributo mensaje
	var $mysqli; // declaración del atributo manejador de la bd

	//Constructor de la clase

	function __construct($idNotificacion, $mensaje) {
		//asignación de valores de parámetro a los atributos de la clase
		$this->idNotificacion = $idNotificacion;
		$this->mensaje = $mensaje;

		// incluimos la funcion de acceso a la bd
		include_once '../Functions/AccessBD.php';
		// conectamos con la bd y guardamos el manejador en un atributo de la clase
		$this->mysqli = ConectarBD();

	} // fin del constructor

	//funcion de destrucción del objeto: se ejecuta automaticamente al finalizar el script
	function __destruct() {
	} // fin del metodo destruct

	//funcion SEARCH: hace una búsqueda en la tabla con los datos proporcionados. Si van vacios devuelve todos
	function SEARCH() {
		// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
		$sql = "SELECT  idNotificacion,
						mensaje
       			FROM NOTIFICACION
    			WHERE 
    				( (BINARY `idNotificacion` LIKE '%$this->idNotificacion%') &&
	 				(BINARY `mensaje` LIKE '%$this->mensaje%') )";
		// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'Error en la consulta sobre la base de datos';
		} else { // si la busqueda es correcta devolvemos el recordset resultado

			return $resultado;
		}
	} // fin metodo SEARCH

	//Metodo ADD()
	//Inserta en la tabla  de la bd  los valores de los atributos del objeto. Comprueba si la clave/s esta vacia y 
	//si existe ya en la tabla
	function ADD() {
		if ( ( $this->idNotificacion <> '' ) ) { // si el atributo clave de la entidad no esta vacio

			// construimos el sql para buscar esa clave en la tabla
			$sql = "SELECT * 
					FROM NOTIFICACION 
					WHERE (`idNotificacion` COLLATE utf8_bin = '$this->idNotificacion')";

			if ( !$result = $this->mysqli->query( $sql ) ) { // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el contmayorPujaador manejara
			} else { // si la ejecución de la query no da error

				if ( $result->num_rows == 0 ) { // miramos si el resultado de la consulta es vacio (no existe el idNotificacion)
					// construimos el sql para buscar esa clave candidata en la tabla
					$sql = "SELECT * 
							FROM NOTIFICACION 
							WHERE  (`mensaje` COLLATE utf8_bin = '$this->mensaje')";

					if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el mensaje)
						// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
						return 'Ya existe una notificacion con el mensaje introducido en la base de datos';// ya existe
						
					} else {

						$sql = "INSERT INTO NOTIFICACION (
									`idNotificacion`,
									`mensaje`) 
								VALUES(
									'$this->idNotificacion',
									'$this->mensaje')";
					}
					if ( !$this->mysqli->query( $sql ) ) { // si da error en la ejecución del insert devolvemos mensaje
						return 'Error en la inserción';
					} else { //si no da error en la insercion devolvemos mensaje de exito
						return 'Inserción realizada con éxito'; //operacion de insertado correcta
					}
				} else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
					return 'Ya existe la notificacion introducida en la base de datos'; // ya existe
			}
		} else { // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
			return 'Introduzca un valor'; // introduzca un valor para el usuario
		}
	} // fin del metodo ADD

	// funcion DELETE()
	//Comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
	//se manda un mensaje de que ese valor de clave no existe
	function DELETE() {
		// se construye la sentencia sql de busqueda con los atributos de la clase
		$sql = "SELECT * 
				FROM NOTIFICACION 
				WHERE (`idNotificacion` COLLATE utf8_bin = '$this->idNotificacion')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si existe una tupla con ese valor de clave
		if ( $result->num_rows == 1 ) {
			// se construye la sentencia sql de borrado
			$sql = "DELETE FROM NOTIFICACION 
					WHERE (`idNotificacion` COLLATE utf8_bin = '$this->idNotificacion' )";
			// se ejecuta la query
			$this->mysqli->query( $sql );
			// se devuelve el mensaje de borrado correcto
			return "Borrado correctamente";
		} // si no existe el idNotificacion a borrar se devuelve el mensaje de que no existe
		else
			return "No existe";
	} // fin metodo DELETE

	// funcion RellenaDatos()
	//Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	//en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla
		$sql = "SELECT * 
				FROM NOTIFICACION 
				WHERE (`idNotificacion` COLLATE utf8_bin = '$this->idNotificacion')";
		// Si la busqueda no da resultados, se devuelve el mensaje de que no existe
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'No existe en la base de datos'; // 
		} else { // si existe se devuelve la tupla resultado
			$result = $resultado->fetch_array();
			return $result;
		}
	} // fin del metodo RellenaDatos()
} //fin de clase
?>