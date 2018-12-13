<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class USUARIOS_Model { //declaración de la clase

	var $login; // declaración del atributo login
	var $password; //declaración del atributo password
	var $nombre; // declaración del atributo nombre
	var $email; // declaración del atributo email
	var $avatar; // declaración del atributo avatar
	var $rol; //declaración del atributo rol
	var $mysqli; // declaración del atributo manejador de la bd

	//Constructor de la clase

	function __construct( $login, $password, $nombre, $email, $avatar, $rol) {
		//asignación de valores de parámetro a los atributos de la clase
		$this->login = $login;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->avatar = $avatar;
		$this->rol = $rol;

		// incluimos la funcion de acceso a la bd
		include_once '../Functions/AccessBD.php';
		// conectamos con la bd y guardamos el manejador en un atributo de la clase
		$this->mysqli = ConectarBD();

	} // fin del constructor

	//funcion SEARCH: hace una búsqueda en la tabla con
	//los datos proporcionados. Si van vacios devuelve todos
	function SEARCH() {
		// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
		$sql = "SELECT  login,
					password,
					nombre,
					email,
					avatar,
					rol
       			FROM USUARIOS 
    			WHERE 
    				(
					(BINARY login LIKE '%$this->login%') &&
					(BINARY password LIKE '%$this->password%') &&
					(BINARY nombre LIKE '%$this->nombre%') &&
	 				(BINARY email LIKE '%$this->email%') &&
					(BINARY avatar LIKE'%$this->avatar%') &&
					(BINARY rol LIKE'%$this->rol%')
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
		if ( ( $this->login <> '' ) ) { // si el atributo clave de la entidad no esta vacio

			// construimos el sql para buscar esa clave en la tabla
			$sql = "SELECT * 
					FROM USUARIOS 
					WHERE (  login COLLATE utf8_bin = '$this->login')";

			if ( !$result = $this->mysqli->query( $sql ) ) { // si da error la ejecución de la query
				return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
			} else { // si la ejecución de la query no da error

				if ( $result->num_rows == 0 ) { // miramos si el resultado de la consulta es vacio (no existe el login)
					// construimos el sql para buscar esa clave candidata en la tabla
					$sql = "SELECT * 
							FROM USUARIOS 
							WHERE  (email COLLATE utf8_bin = '$this->email')";

					if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el email)
						// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
						return 'Ya existe un usuario con el email introducido en la base de datos';// ya existe
						
					} else {

						$sql = "INSERT INTO USUARIOS (
									login,
									password,
									nombre,
									email,
									avatar,
									rol) 
								VALUES(
									'$this->login',
									'$this->password',
									'$this->nombre',
									'$this->email',
									'$this->avatar',
									'$this->rol')";
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
				WHERE (login COLLATE utf8_bin = '$this->login')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si existe una tupla con ese valor de clave
		if ( $result->num_rows == 1 ) {
			// se construye la sentencia sql de borrado
			$sql = "DELETE FROM USUARIOS 
					WHERE (login COLLATE utf8_bin = '$this->login' )";
			// se ejecuta la query
			$this->mysqli->query( $sql );
			// se devuelve el mensaje de borrado correcto
			return "Borrado correctamente";
		} // si no existe el login a borrar se devuelve el mensaje de que no existe
		else
			return "No existe";
	} // fin metodo DELETE

	// funcion RellenaDatos()
	// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	// en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla
		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE (login COLLATE utf8_bin = '$this->login')";
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
				WHERE (login COLLATE utf8_bin = '$this->login')";
		// se ejecuta la query
		$result = $this->mysqli->query( $sql );
		// si el numero de filas es igual a uno es que lo encuentra
		if ( $result->num_rows == 1 ) { // se construye la sentencia de modificacion en base a los atributos de la clase
			if($this->avatar <> null){
				$sql = "UPDATE USUARIOS SET 
							login = '$this->login',
							password = '$this->password',
							nombre = '$this->nombre',
							email = '$this->email',
							avatar = '$this->avatar' ,
							rol = '$this->rol'
						WHERE ( login COLLATE utf8_bin = '$this->login')";
			}else{
				$sql = "UPDATE USUARIOS SET 
							login = '$this->login',
							password = '$this->password',
							nombre = '$this->nombre',
							email = '$this->email' ,
							rol = '$this->rol'
						WHERE ( login COLLATE utf8_bin = '$this->login')";
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


	// funcion login: realiza la comprobación de si existe el usuario en la bd y despues si la pass
	// es correcta para ese usuario. Si es asi devuelve true, en cualquier otro caso devuelve el 
	// error correspondiente
	function login() {

		$sql = "SELECT *
				FROM USUARIOS
				WHERE ((login COLLATE utf8_bin = '$this->login'))";
		$resultado = $this->mysqli->query( $sql );
		if ( $resultado->num_rows == 0 ) {
			return 'El usuario no existe';
		} else {
			$tupla = $resultado->fetch_array();
			if ( $tupla[ 'password' ] == $this->password ) {
				return true;
			} else {
				return 'La password para este usuario no es correcta';
			}
		}
	} //fin metodo login

	//
	function Register() {

		$sql = "SELECT * 
				FROM USUARIOS 
				WHERE login COLLATE utf8_bin = '" . $this->login . "'";
		$result = $this->mysqli->query( $sql );
		if ( $result->num_rows == 1 ) { // existe el usuario
			return 'El usuario ya existe';	
		} else {
			// construimos el sql para buscar esa clave candidata en la tabla
			$sql = "SELECT * 
					FROM USUARIOS 
					WHERE  (email COLLATE utf8_bin = '$this->email')";
			if ( $result->num_rows != 0 ) {// miramos si el resultado de la consulta no es vacio ( existe el email)
				// si ya existe ese valor de clave en la tabla devolvemos el mensaje correspondiente
				return 'Ya existe un usuario con el email introducido en la base de datos';// ya existe
			}else{
				return true; //no existe el usuario
			}
		}
	}
} //fin de clase
?>