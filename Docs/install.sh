#!/bin/bash

#Concesión de permisos y copia de la base de datos a la máquina host

chmod a+w+r+x -R ./ET4/

mysql -u root --password=iu < ./ET4/scriptBD.sql 
