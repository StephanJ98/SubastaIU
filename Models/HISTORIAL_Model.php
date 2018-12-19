<?php
/*
	Autor: 	GUI
	idSubasta de creación: 14/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class HISTORIAL_Model { //declaración de la clase
	var $idHistorial; // declaración del atributo idHistorial (Representa el codigo de linea dentro del historial)
	var $idSubasta; //declaración del atributo idSubasta
	var $idUser; // declaración del atributo idUser
	var $idPuja; // declaración del atributo idPuja
	var $importe; // declaración del atributo importe
	var $mysqli; // declaración del atributo manejador de la bd

	//Constructor de la clase
	function __construct($idHistorial, $idSubasta, $idUser, $idPuja, $importe) {
		//asignación de valores de parámetro a los atributos de la clase
		$this->idHistorial = $idHistorial;
		$this->idSubasta = $idSubasta;
		$this->idUser = $idUser;
		$this->idPuja = $idPuja;
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
		$sql = "SELECT  idHistorial,
						idSubasta,
						idUser,
						idPuja,
						importe
       			FROM HISTORIAL
    			WHERE 
    				( (BINARY idHistorial LIKE '%$this->idHistorial%') &&
					(BINARY idSubasta LIKE '%$this->idSubasta%') &&
					(BINARY idUser LIKE '%$this->idUser%') &&
	 				(BINARY idPuja LIKE '%$this->idPuja%') &&
	 				(BINARY importe LIKE '%$this->importe%') )";
		// si se produce un error en la busqueda mandamos el idPuja de error en la consulta
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
		if ( ( $this->idHistorial <> '' ) ) { // si el atributo clave de la entidad no esta vacio

			// construimos el sql para buscar esa clave en la tabla
			$sql = "SELECT * 
					FROM HISTORIAL 
					WHERE (idHistorial COLLATE utf8_bin = '$this->idHistorial')";

			if ( !$result = $this->mysqli->query( $sql ) ) { // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un idPuja que el contmayorPujaador manejara
			} else { // si la ejecución de la query no da error

				if ( $result->num_rows == 0 ) { // miramos si el resultado de la consulta es vacio (no existe el idHistorial)
					// construimos el sql para buscar esa clave candidata en la tabla
					$sql = "SELECT * 
							FROM HISTORIAL 
							WHERE (idHistorial COLLATE utf8_bin = '$this->idHistorial')";

					if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el idPuja)
						// si ya existe ese valor de clave en la tabla devolvemos el idPuja correspondiente
						return 'Ya existe una linea con el codigo introducido en la base de datos';// ya existe
						
					} else {

						$sql = "INSERT INTO HISTORIAL (
									idHistorial,
									idSubasta,
									idUser,
									idPuja,
									importe) 
								VALUES(
									'$this->idHistorial',
									'$this->idSubasta',
									'$this->idUser',
									'$this->idPuja',
									'$this->importe')";
					}
					if ( !$this->mysqli->query( $sql ) ) { // si da error en la ejecución del insert devolvemos idPuja
						return 'Error en la inserción';
					} else { //si no da error en la insercion devolvemos idPuja de exito
						return 'Inserción realizada con éxito'; //operacion de insertado correcta
					}
				} else // si ya existe ese valor de clave en la tabla devolvemos el idPuja correspondiente
					return 'Ya existe la linea introducida en la base de datos'; // ya existe
			}
		} else { // si el atributo clave de la bd es vacio solicitamos un valor en un idPuja
			return 'Introduzca un valor'; // introduzca un valor para el usuario
		}
	} // fin del metodo ADD

	// funcion RellenaDatos()
	//Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	//en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla
		$sql = "SELECT * 
				FROM HISTORIAL 
				WHERE (idHistorial COLLATE utf8_bin = '$this->idHistorial')";
		// Si la busqueda no da resultados, se devuelve el idPuja de que no existe
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'No existe en la base de datos'; // 
		} else { // si existe se devuelve la tupla resultado
			$result = $resultado->fetch_array();
			return $result;
		}
	} // fin del metodo RellenaDatos()
} //fin de clase
?>