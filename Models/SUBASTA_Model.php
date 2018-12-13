<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class SUBASTA_Model { //declaración de la clase

	var $idSubasta; // declaración del atributo idSubasta
	var $producto; //declaración del atributo producto
	var $info; // declaración del atributo info
	var $ficheroSubasta; // declaración del atributo ficheroSubasta
	var $esCiega; // declaración del atributo esCiega
	var $mayorPuja; // declaración del atributo mayoPuja
	var $mysqli; // declaración del atributo manejador de la bd

	//Constructor de la clase

	function __construct($idSubasta, $producto, $info, $ficheroSubasta, $esCiega, $mayorPuja) {
		//asignación de valores de parámetro a los atributos de la clase
		$this->idSubasta = $idSubasta;
		$this->producto = $producto;
		$this->info = $info;
		$this->ficheroSubasta = $ficheroSubasta;
		$this->esCiega = $esCiega;
		$this->mayorPuja = $mayorPuja;

		// incluimos la funcion de acceso a la bd
		include_once '../Functions/AccessBD.php';
		// conectamos con la bd y guardamos el manejador en un atributo de la clase
		$this->mysqli = ConectarBD();

	} // fin del constructor

	//funcion SEARCH: hace una búsqueda en la tabla con
	//los datos proporcionados. Si van vacios devuelve todos
	function SEARCH() {
		// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
		$sql = "SELECT  idSubasta,
					producto,
					info,
					ficheroSubasta,
					esCiega,
					mayorPuja
       			FROM USUARIOS 
    			WHERE 
    				(
					(BINARY idSubasta LIKE '%$this->idSubasta%') &&
					(BINARY producto LIKE '%$this->producto%') &&
					(BINARY info LIKE '%$this->info%') &&
	 				(BINARY ficheroSubasta LIKE '%$this->ficheroSubasta%') &&
					(BINARY esCiega LIKE'%$this->esCiega%') &&
					(BINARY mayorPuja LIKE'%$this->mayorPuja%')
    				)";
		// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'Error en la consulta sobre la base de datos';
		} else { // si la busqueda es correcta devolvemos el recordset resultado

			return $resultado;
		}
	} // fin metodo SEARCH


	//Metodo ADD()
	//Inserta en la tabla  de la bd  los valores
	// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
	//existe ya en la tabla
	function ADD() {
		if ( ( $this->idSubasta <> '' ) ) { // si el atributo clave de la entidad no esta vacio

			// construimos el sql para buscar esa clave en la tabla
			$sql = "SELECT * 
					FROM USUARIOS 
					WHERE (  idSubasta COLLATE utf8_bin = '$this->idSubasta')";

			if ( !$result = $this->mysqli->query( $sql ) ) { // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el contmayorPujaador manejara
			} else { // si la ejecución de la query no da error

				if ( $result->num_rows == 0 ) { // miramos si el resultado de la consulta es vacio (no existe el idSubasta)
					// construimos el sql para buscar esa clave candidata en la tabla
					$sql = "SELECT * 
							FROM USUARIOS 
							WHERE  (ficheroSubasta COLLATE utf8_bin = '$this->ficheroSubasta')";

					if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el ficheroSubasta)
						// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
						return 'Ya existe un usuario con el ficheroSubasta introducido en la base de datos';// ya existe
						
					} else {

						$sql = "INSERT INTO USUARIOS (
									idSubasta,
									producto,
									info,
									ficheroSubasta,
									esCiega,
									mayorPuja) 
								VALUES(
									'$this->idSubasta',
									'$this->producto',
									'$this->info',
									'$this->ficheroSubasta',
									'$this->esCiega',
									'$this->mayorPuja')";
					}
					if ( !$this->mysqli->query( $sql ) ) { // si da error en la ejecución del insert devolvemos mensaje
						return 'Error en la inserción';
					} else { //si no da error en la insercion devolvemos mensaje de exito
						return 'Inserción realizada con éxito'; //operacion de insertado correcta
					}
				} else // si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
					return 'Ya existe el usuario introducido en la base de datos'; // ya existe
			}
		} else { // si el atributo clave de la bd es vacio solicitamos un valor en un mensaje
			return 'Introduzca un valor'; // introduzca un valor para el usuario
		}
	} // fin del metodo ADD

	//funcion de destrucción del objeto: se ejecuta automaticamente
	//al finalizar el script
	function __destruct() {

	} // fin del metodo destruct

	// funcion DELETE()
	// comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
	// se manda un mensaje de que ese valor de clave no existe
	function DELETE() {
		// se construye la sentencia sql de busqueda con los atributos de la clase
		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE (idSubasta COLLATE utf8_bin = '$this->idSubasta')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si existe una tupla con ese valor de clave
		if ( $result->num_rows == 1 ) {
			// se construye la sentencia sql de borrado
			$sql = "DELETE FROM USUARIOS 
					WHERE (idSubasta COLLATE utf8_bin = '$this->idSubasta' )";
			// se ejecuta la query
			$this->mysqli->query( $sql );
			// se devuelve el mensaje de borrado correcto
			return "Borrado correctamente";
		} // si no existe el idSubasta a borrar se devuelve el mensaje de que no existe
		else
			return "No existe";
	} // fin metodo DELETE

	// funcion RellenaDatos()
	// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	// en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla
		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE (idSubasta COLLATE utf8_bin = '$this->idSubasta')";
		// Si la busqueda no da resultados, se devuelve el mensaje de que no existe
		if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
			return 'No existe en la base de datos'; // 
		} else { // si existe se devuelve la tupla resultado
			$result = $resultado->fetch_array();
			return $result;
		}
	} // fin del metodo RellenaDatos()

	// funcion EDIT()
	// Se comprueba que la tupla a modificar exista en base al valor de su clave primaria
	// si existe se modifica
	function EDIT() {
		// se construye la sentencia de busqueda de la tupla en la bd
		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE (idSubasta COLLATE utf8_bin = '$this->idSubasta')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si el numero de filas es igual a uno es que lo encuentra
		if ( $result->num_rows == 1 ) { // se construye la sentencia de modificacion en base a los atributos de la clase
			if($this->esCiega <> null){
				$sql = "UPDATE USUARIOS SET 
							idSubasta = '$this->idSubasta',
							producto = '$this->producto',
							info = '$this->info',
							ficheroSubasta = '$this->ficheroSubasta',
							esCiega = '$this->esCiega' ,
							mayorPuja = '$this->mayorPuja'
						WHERE ( idSubasta COLLATE utf8_bin = '$this->idSubasta')";
			}else{
				$sql = "UPDATE USUARIOS SET 
							idSubasta = '$this->idSubasta',
							producto = '$this->producto',
							info = '$this->info',
							ficheroSubasta = '$this->ficheroSubasta' ,
							mayorPuja = '$this->mayorPuja'
						WHERE ( idSubasta COLLATE utf8_bin = '$this->idSubasta')";
			}
			// si hay un problema con la query se envia un mensaje de error en la modificacion
			if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
				return 'Error en la modificación';
			} else { // si no hay problemas con la modificación se indica que se ha modificado
				return 'Modificado correctamente';
			}
		} else // si no se encuentra la tupla se manda el mensaje de que no existe la tupla
			return 'No existe en la base de datos';
	} // fin del metodo EDIT


	// funcion idSubasta: realiza la comprobación de si existe el usuario en la bd y despues si la pass
	// es correcta para ese usuario. Si es asi devuelve true, en cualquier otro caso devuelve el 
	// error correspondiente
	function idSubasta() {

		$sql = "SELECT *
				FROM USUARIOS
				WHERE ((idSubasta COLLATE utf8_bin = '$this->idSubasta'))";
		$resultado = $this->mysqli->query( $sql );
		if ( $resultado->num_rows == 0 ) {
			return 'El usuario no existe';
		} else {
			$tupla = $resultado->fetch_array();
			if ( $tupla[ 'producto' ] == $this->producto ) {
				return true;
			} else {
				return 'La producto para este usuario no es correcta';
			}
		}
	} //fin metodo idSubasta

	//
	function Register() {

		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE idSubasta COLLATE utf8_bin = '" . $this->idSubasta . "'";
		$result = $this->mysqli->query( $sql );
		if ( $result->num_rows == 1 ) { // existe el usuario
			return 'El usuario ya existe';	
		} else {
			// construimos el sql para buscar esa clave candidata en la tabla
			$sql = "SELECT * 
					FROM USUARIOS 
					WHERE  (ficheroSubasta COLLATE utf8_bin = '$this->ficheroSubasta')";
			if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el ficheroSubasta)
				// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
				return 'Ya existe un usuario con el ficheroSubasta introducido en la base de datos';// ya existe
			}else{
				return true; //no existe el usuario
			}
		}
	}
} //fin de clase
?>