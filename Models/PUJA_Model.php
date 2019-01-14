<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class PUJA_Model { //declaración de la clase

	var $idPuja; // declaración del atributo idPuja
	var $idSubasta; //declaración del atributo idSubasta
	var $idUser; // declaración del atributo idUser
	var $importe; // declaración del atributo importe
	var $mysqli; // declaración del atributo manejador de la bd

	//Constructor de la clase

	function __construct($idPuja, $idSubasta, $idUser, $importe) {
		//asignación de valores de parámetro a los atributos de la clase
		$this->idPuja = $idPuja;
		$this->idSubasta = $idSubasta;
		$this->idUser = $idUser;
		$this->importe = $importe;

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
		$sql = "SELECT  idPuja,
						idSubasta,
						idUser,
						importe
       			FROM PUJA
    			WHERE 
    				( (BINARY `idPuja` LIKE '%$this->idPuja%') &&
					(BINARY `idSubasta` LIKE '%$this->idSubasta%') &&
					(BINARY `idUser` LIKE '%$this->idUser%') &&
	 				(BINARY `importe` LIKE '%$this->importe%') )";
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
		if ( ( $this->idPuja <> '' ) ) { // si el atributo clave de la entidad no esta vacio

			// construimos el sql para buscar esa clave en la tabla
			$sql = "SELECT * 
					FROM PUJAS 
					WHERE (`idPuja` COLLATE utf8_bin = '$this->idPuja')";

			if ( !$result = $this->mysqli->query( $sql ) ) { // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el contmayorPujaador manejara
			} else { // si la ejecución de la query no da error

				if ( $result->num_rows == 0 ) { // miramos si el resultado de la consulta es vacio (no existe el idPuja)
					// construimos el sql para buscar esa clave candidata en la tabla
					$sql = "SELECT * 
							FROM PUJAS 
							WHERE  (`importe` COLLATE utf8_bin = '$this->importe')";

					if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el importe)
						// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
						return 'Ya existe una puja con el importe introducido en la base de datos';// ya existe
						
					} else {

						$sql = "INSERT INTO PUJAS (
									`idPuja`,
									`idSubasta`,
									`idUser`,
									`importe`) 
								VALUES(
									'$this->idPuja',
									'$this->idSubasta',
									'$this->idUser',
									'$this->importe')";
					}
					if ( !$this->mysqli->query( $sql ) ) { // si da error en la ejecución del insert devolvemos mensaje
						return 'Error en la inserción';
					} else { //si no da error en la insercion devolvemos mensaje de exito
						return 'Inserción realizada con éxito'; //operacion de insertado correcta
					}
				} else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
					return 'Ya existe la puja introducido en la base de datos'; // ya existe
			}
		} else { // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
			return 'Introduzca un valor'; // introduzca un valor para el usuario
		}
	} // fin del metodo ADD

	// funcion DELETE()
	//Comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
	//se manda un mensaje de que ese valor de clave no existe
	/*function DELETE() {//No necesaria
		// se construye la sentencia sql de busqueda con los atributos de la clase
		$sql = "SELECT * 
				FROM PUJAS 
				WHERE (`idPuja` COLLATE utf8_bin = '$this->idPuja')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si existe una tupla con ese valor de clave
		if ( $result->num_rows == 1 ) {
			// se construye la sentencia sql de borrado
			$sql = "DELETE FROM PUJAS 
					WHERE (`idPuja` COLLATE utf8_bin = '$this->idPuja' )";
			// se ejecuta la query
			$this->mysqli->query( $sql );
			// se devuelve el mensaje de borrado correcto
			return "Borrado correctamente";
		} // si no existe el idPuja a borrar se devuelve el mensaje de que no existe
		else
			return "No existe";
	} // fin metodo DELETE*/

	// funcion RellenaDatos()
	//Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	//en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla
		$sql = "SELECT * 
				FROM PUJAS 
				WHERE (`idPuja` COLLATE utf8_bin = '$this->idPuja')";
		// Si la busqueda no da resultados, se devuelve el mensaje de que no existe
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'No existe en la base de datos'; // 
		} else { // si existe se devuelve la tupla resultado
			$result = $resultado->fetch_array();
			return $result;
		}
	} // fin del metodo RellenaDatos()

	// funcion EDIT()  //No necesaria
	// Se comprueba que la tupla a modificar exista en base al valor de su clave primaria
	// si existe se modifica
	/*function EDIT() {
		// se construye la sentencia de busqueda de la tupla en la bd
		$sql = "SELECT * 
				FROM PUJAS 
				WHERE (`idPuja` COLLATE utf8_bin = '$this->idPuja')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si el numero de filas es igual a uno es que lo encuentra
		if ( $result->num_rows == 1 ) { // se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE PUJAS SET 
						`idPuja` = '$this->idPuja',
						`idSubasta` = '$this->idSubasta',
						`idUser` = '$this->idUser',
						`importe` = '$this->importe'
					WHERE ( `idPuja` COLLATE utf8_bin = '$this->idPuja')";
			// si hay un problema con la query se envia un mensaje de error en la modificacion
			if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
				return 'Error en la modificación';
			} else { // si no hay problemas con la modificación se indica que se ha modificado
				return 'Modificado correctamente';
			}
		} else // si no se encuentra la tupla se manda el mensaje de que no existe la tupla
			return 'No existe en la base de datos';
	} // fin del metodo EDIT*/
} //fin de clase
?>