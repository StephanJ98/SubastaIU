-- GUI - 10/12/2018
-- script de creación de la bd GUIBD.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `GUIBD`;
CREATE DATABASE `GUIBD` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `GUIBD`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `GUIBD`@`localhost`;
DROP USER `GUIBD`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `GUIBD`@`localhost` IDENTIFIED BY 'passGUIBD';
GRANT USAGE ON *.* TO `GUIBD`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `GUIBD`.* TO `GUIBD`@`localhost` WITH GRANT OPTION; 
--
-- Estructura de tabla para la tabla `USUARIO`
--
CREATE TABLE IF NOT EXISTS `USUARIO`(
`idUser` varchar(30) NOT NULL,
`password` varchar(128) NOT NULL,
`nombre` varchar(150) NOT NULL,
`email` varchar(60) NOT NULL,
`avatar` varchar(60) NOT NULL,
`rol` varchar(1) NOT NULL,
PRIMARY KEY (`idUser`),
FOREIGN KEY (`rol`) REFERENCES ROL(`idRol`),
UNIQUE KEY `email` (`email`),
UNIQUE KEY `avatar` (`avatar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`idUser`, `password`, `nombre`, `email`, `avatar`, `rol`) VALUES ('admin', 'admin', 'administrador', 'admin@admin.fr', '', '0');

--
-- Estructura de tabla para la tabla `ROL`
--
CREATE TABLE IF NOT EXISTS `ROL`(
`idRol` varchar(1) NOT NULL,
`nomRol` varchar(15) NOT NULL,
`descripRol` varchar(300) NOT NULL,
PRIMARY KEY (`idRol`),
UNIQUE KEY `NomRol` (`NomRol`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ROL(`idRol`,`nomRol`,`descripRol`) VALUES ('0','Administrador','Supervisa usuarios y subastas.');
INSERT INTO ROL(`idRol`,`nomRol`,`descripRol`) VALUES ('1','Pujador','Solo puede pujar.');
INSERT INTO ROL(`idRol`,`nomRol`,`descripRol`) VALUES ('2','Subastador','Crea subastas.');

--
-- Estructura de tabla para la tabla `SUBASTA`
-- 
CREATE TABLE IF NOT EXISTS `SUBASTA`(
`idSubasta` varchar(30) NOT NULL,
`producto` varchar(30) NOT NULL,
`info` varchar(30) NOT NULL,
`ficheroSubasta` varchar(60) NOT NULL,
`esCiega` varchar(30) NOT NULL,
`mayorPuja` varchar(50) NOT NULL,
PRIMARY KEY (`idSubasta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `PUJA`
-- 
CREATE TABLE IF NOT EXISTS `PUJA`(
`idPuja` varchar(30) NOT NULL,
`idSubasta` varchar(30) NOT NULL,
`idUser` varchar(30) NOT NULL,
`importe` varchar(50) NOT NULL,
PRIMARY KEY (`idPuja`),
FOREIGN KEY (`idSubasta`) REFERENCES SUBASTA(`idSubasta`),
FOREIGN KEY (`idUser`) REFERENCES USUARIO(`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `NOTIFICACION`
-- 
CREATE TABLE IF NOT EXISTS `NOTIFICACION`(
`idNotificacion` varchar(30) NOT NULL,
`fecha` date NOT NULL,
`idUser` varchar(30) NOT NULL,
`mensaje` varchar(300) NOT NULL,
PRIMARY KEY (`idNotificacion`),
FOREIGN KEY (`idUser`) REFERENCES USUARIO(`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `HISTORIAL`
-- 
CREATE TABLE IF NOT EXISTS `HISTORIAL`(
`idHistorial` varchar(30) NOT NULL,
`idSubasta` varchar(30) NOT NULL,
`idUser` varchar(30) NOT NULL,
`idPuja` varchar(30) NOT NULL,
`importe` varchar(50) NOT NULL,
PRIMARY KEY (`idHistorial`),
FOREIGN KEY (`idSubasta`) REFERENCES SUBASTA(`idSubasta`),
FOREIGN KEY (`idUser`) REFERENCES USUARIO(`idUser`),
FOREIGN KEY (`idPuja`) REFERENCES PUJA(`idPuja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;