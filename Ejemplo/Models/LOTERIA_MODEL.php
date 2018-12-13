<?php

/*
	Archivo php
	Nombre: LOTERIA_MODEL.php
	Autor: 	cvy3ms
	Fecha de creación: 19/11/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class LOTERIA_Model { //declaración de la clase

            var $email;
            var $nombre;
            var $apellidos;
            var $participacion;
            var $resguardo;
            var $ingresado;
            var $premiopersonal;
            var $pagado;
	//Constructor de la clase
        function __construct($email,$nombre,$apellidos,$participacion,$resguardo,$ingresado,$premiopersonal,$pagado){
            $this->email = $email;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->participacion = $participacion;
            $this->resguardo = $resguardo;
            $this->ingresado = $ingresado;
            $this->premiopersonal = $premiopersonal;
			$this->pagado = $pagado;
	// incluimos la funcion de acceso a la bd
		include_once '../Functions/BdAdmin.php';
			
  	// conectamos con la bd y guardamos el manejador en un atributo de la clase
		$this->mysqli = ConectarBD();


}

	//funcion SEARCH: hace una búsqueda en la tabla con
	//los datos proporcionados. Si van vacios devuelve todos
	function SEARCH() {
		// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
		$sql = "select 
                        `lot.email` as email, 
                        `lot.nombre` as nombre,
                        `lot.apellidos` as apellidos,
                        `lot.participacion` as participacion,
                        `lot.resguardo` as resguardo,
                        `lot.ingresado` as ingresado,
                        `lot.premiopersonal` as premiopersonal,
                        `lot.pagado`as pagado
                from LOTERIAIU 
                where 
                    ((
                         `lot.email` LIKE '%$this->email%')&&
                         (`lot.nombre` LIKE '%$this->nombre%')&&
                         (`lot.apellidos` LIKE '%$this->apellidos%')&&
                         (`lot.participacion` LIKE '%$this->participacion%')&&
                         (`lot.resguardo` LIKE '%$this->resguardo%')&&
                         (`lot.ingresado` LIKE '%$this->ingresado%')&&
                         (`lot.premiopersonal` LIKE '%$this->premiopersonal%')&&
						 (`lot.pagado` LIKE '%$this->pagado%'))";
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
    //Anadir
    function ADD()
    {
        
     
        $sql = "SELECT * FROM LOTERIAIU WHERE `lot.email`='$this->email'";
        if (!$result = $this->mysqli->query($sql)){
            return 'No se ha podido conectar con la base de datos'; // error en la consulta (no se ha podido conectar con la bd
        }
        else {
            if ($result->num_rows == 0){
                
                $sql = "INSERT INTO LOTERIAIU (
                        `lot.email`, 
                        `lot.nombre`,
                        `lot.apellidos`,
                        `lot.participacion`,
                        `lot.resguardo`,
                        `lot.ingresado`,
                        `lot.premiopersonal`,
                        `lot.pagado`) 
                        VALUES (
                        '$this->email',
                        '$this->nombre',
                        '$this->apellidos',
                        '$this->participacion',
                        '$this->resguardo',
                        '$this->ingresado',
                        '$this->premiopersonal',
						'$this->pagado')";

                if (!$this->mysqli->query($sql)) {
                    return 'Error en la inserción';
                }
                else{
                    return 'Inserción realizada con éxito'; //operacion de insertado correcta
                }
                
            }
            else
                return 'Ya existe en la base de datos'; // ya existe
        
    }
}
	//funcion de destrucción del objeto: se ejecuta automaticamente
	//al finalizar el script
	function __destruct() {

	} // fin del metodo destruct

	// funcion DELETE()
	// comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
	// se manda un mensaje de que ese valor de clave no existe
	function DELETE() {

    
    $sql = "SELECT * FROM LOTERIAIU WHERE `lot.email`= '$this->email'";
		echo($sql);
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "DELETE FROM LOTERIAIU WHERE `lot.email`= '$this->email'";
		echo($sql);
        $this->mysqli->query($sql);
		
        return "Borrado correctamente";
    }
    else
        return "No existe en la base de datos";
	} // fin metodo DELETE

	// funcion RellenaDatos()
	// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
	// en el atributo de la clase
	function RellenaDatos() { // se construye la sentencia de busqueda de la tupla

		$sql = "SELECT  `lot.email` as email, 
                        `lot.nombre` as nombre,
                        `lot.apellidos` as apellidos,
                        `lot.participacion` as participacion,
                        `lot.resguardo` as resguardo,
                        `lot.ingresado` as ingresado,
                        `lot.premiopersonal` as premiopersonal,
                        `lot.pagado`as pagado
						FROM LOTERIAIU WHERE (`lot.email` = '$this->email')";
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
	   $sql = "SELECT * FROM LOTERIAIU WHERE `lot.email`= '$this->email'";
    

    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
        $sql = "UPDATE LOTERIAIU SET 
				`lot.email` = '$this->email',
				`lot.nombre` = '$this->nombre',
				`lot.apellidos` = '$this->apellidos',
				`lot.participacion` = '$this->participacion',
				`lot.resguardo` = '$this->resguardo',
				`lot.ingresado` = '$this->ingresado',
				`lot.premiopersonal` = '$this->premiopersonal',
				`lot.pagado` = '$this->pagado'
				WHERE `lot.email`= '$this->email'";
        
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la modificación'; 
        }
        else{
            return 'Modificado correctamente';
        }
    }
    else
        return 'No existe en la base de datos';
	} // fin del metodo EDIT



} //fin de clase

?>