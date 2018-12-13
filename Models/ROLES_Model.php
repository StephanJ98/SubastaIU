<?php
/*
	Autor: 	GUI
	Fecha de creación: 13/12/2018 
	Función: modelo de datos definida en una clase que permite interactuar con la base de datos
*/
class ROLES_Model {
    
    var $id_rol; //declaración del atributo id_rol
    var $nombre_rol; //declaración del atributo nombre_rol
    var $desc_rol; //declaración del atributo desc_rol
    var $mysqli; //declaracion del atributo manejador de la bd
    
    //Constructor de la clase
    
    function __construct( $id_rol, $nombre_rol, $desc_rol) {
        //asignación de valores de parámetro a los atributos de la clase
        $this->id_rol = $id_rol;
        $this->nombre_rol = $nombre_rol;
        $this->desc_rol = $desc_rol;
        
        //Incluimos la función de acceso a la bd
        include_once '../Functions/AccessDB.php';
        //conectamos con la bd y guardamos el manejador en un atributo de la clase
        $this->mysqli = ConectarDB();
        
    } //fin del constructor
    
    //funcion SEARCH: hace una búsqueda en la tabla con
    //los datos proporcionados. Si van vacíos devuelve todos
    function SEARCH() {
        // construimos la sentencia de busqueda con LIKE y los atributos de la entidad
        $sql = "SEARCH id_rol,
                    nombre_rol,
                    desc_rol
                FROM ROLES
                WHERE
                    (
                    (BINARY id_rol LIKE '%$this->id_rol%') &&
                    (BINARY nombre_rol LIKE '%$this->nombre_rol%') &&
                    (BINARY desc_rol LIKE '%$this->desc_rol%')
                    )";
        // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
        if ( !( $resultado = $this->mysqli->query( $sql ) ) ) {
            return 'Error en la consulta sobre la base de datos';
        }else { //si la busqueda es correcta devolvemos el recordset resultado
            
            return $resultado;
        
        }
    } //fin metodo SEARCH
        
    //funcion de destrucción del objeto: se ejecuta automaticamente
	//al finalizar el script
	function __destruct() {

	} // fin del metodo destruct
        
} //fin de clase
?>