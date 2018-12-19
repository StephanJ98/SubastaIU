<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018  
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class ROLES_Model {
    
    var $idRol; //declaración del atributo idRol
    var $nombreRol; //declaración del atributo nombreRol
    var $descRol; //declaración del atributo descRol
    var $mysqli; //declaracion del atributo manejador de la bd
    
    //Constructor de la clase
    
    function __construct( $idRol, $nombreRol, $descRol) {
        //asignación de valores de parámetro a los atributos de la clase
        $this->idRol = $idRol;
        $this->nombreRol = $nombreRol;
        $this->descRol = $descRol;
        
        //Incluimos la función de acceso a la bd
        include_once '../Functions/AccessDB.php';
        //conectamos con la bd y guardamos el manejador en un atributo de la clase
        $this->mysqli = ConectarDB();
    } //fin del constructor
    
    //funcion de destrucción del objeto: se ejecuta automaticamente al finalizar el script
    function __destruct() {
    } // fin del metodo destruct

    //funcion SEARCH: hace una búsqueda en la tabla con los datos proporcionados. Si van vacíos devuelve todos
    function SEARCH() {
        // construimos la sentencia de busqueda con LIKE y los atributos de la entidad
        $sql = "SELECT  idRol,
                        nombreRol,
                        descRol
                FROM ROLES
                WHERE
                    (
                    (BINARY idRol LIKE '%$this->idRol%') &&
                    (BINARY nombreRol LIKE '%$this->nombreRol%') &&
                    (BINARY descRol LIKE '%$this->descRol%')
                    )";
        // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
        if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
            return 'Error en la consulta sobre la base de datos';
        }else { //si la busqueda es correcta devolvemos el recordset resultado
            
            return $resultado;
        
        }
    } //fin metodo SEARCH    
} //fin de clase
?>