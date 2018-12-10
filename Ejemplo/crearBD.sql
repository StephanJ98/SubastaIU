-- jrodeiro - 7/10/2017
-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `IU2`;
CREATE DATABASE `IU2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `IU2`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `useriu`@`localhost`;
	DROP USER `useriu`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `useriu`@`localhost` IDENTIFIED BY 'passiu';
GRANT USAGE ON *.* TO `useriu`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `IU2`.* TO `useriu`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--
CREATE TABLE IF NOT EXISTS `USUARIO` (

`login` varchar(15) NOT NULL,

`password` varchar(128) NOT NULL,

`DNI` varchar(9) NOT NULL,

`nombre` varchar(30) NOT NULL,

`apellidos` varchar(50) NOT NULL,

`telefono` varchar(11) NOT NULL,

`email` varchar(60) NOT NULL,

`FechaNacimiento` date NOT NULL,

`fotopersonal` varchar(50) NOT NULL,

`sexo` enum('hombre','mujer') NOT NULL,

PRIMARY KEY (`login`),

UNIQUE KEY `DNI` (`DNI`),

UNIQUE KEY `email` (`email`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `datos`
--

