<script type = "text/javascript" >
/*  Archivo javaScript
	Nombre: validaciones.js
	Autor: 	cvy3ms
	Fecha de creación: 26/11/2018 
	Función: el objetivo principal de este fichero es validar los distintos campos de los formularios, permitiendo así que los datos cumplan los
	requisitos y formatos necesarios para ser válidos. Además se incluyen las funciones asociadas a mostrar el mensaje de error cuando los datos
	son incorrectos
*/


var atributo = new Array();/*Array que sirve para poder traducir el nombre de los atributos de los campos del formulario */
atributo['login'] = '<?php echo $strings["Usuario"]?>';
atributo['password'] = '<?php echo $strings["password"]?>';
atributo['DNI'] = '<?php echo $strings["DNI"]?>';
atributo['nombre'] = '<?php echo $strings["nombre"]?>';
atributo['apellidos'] = '<?php echo $strings["apellidos"]?>';
atributo['telefono'] = '<?php echo $strings["telefono"]?>';
atributo['email'] = '<?php echo $strings["email"]?>';
atributo['FechaNacimiento'] = '<?php echo $strings["FechaNacimiento"]?>';
atributo['fotopersonal'] = '<?php echo $strings["fotopersonal"]?>';
atributo['sexo'] = '<?php echo $strings["sexo"]?>';

/*
		function comprobarVacio(campo): realiza una comprobación de si el campo es vacío o está compuesto de espacios en blanco.
*/
function comprobarVacio(campo) {
	/*Si el campo es nulo, tiene longitud 0 o está compuesto por espacios en blanco, se muestra un mensaje de error y se retorna false*/
	if (campo.value == null || campo.value.length == 0 || /^\s+$/.test(campo.value)) {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede ser vacio"];?>');
		campo.focus();
		return false;
	}
	return true;
}
/*
	function comprobarLongitud(campo,size): realiza una comprobación de si el campo es mayor que el indicado en el parámetro size.
*/
function comprobarLongitud(campo, size) {
	/*Si el campo tiene mayor longitud que size, se manda un aviso de error llamando a la función msgError y se retorna false */
	if (campo.value.length > size) {
		msgError('<?php echo $strings["Longitud incorrecta. El atributo "];?>' +atributo[campo.name] + '<?php echo $strings[" puede tener una longitud máxima de "];?>' + size + '<?php echo $strings[" y es de "];?>' + campo.value.length);
		campo.focus();
		return false;
	}
	return true;
}
/*
	function comrpobarTexto(campo,size): realiza una comprobación de si el valor de campo contiene algún carácter especial.
*/
function comprobarTexto(campo, size) {

	var i; //variable auxiliar de control
	/*Estructura que permite recorrer todos los caracteres del valor de campo */
	for (i = 0; i < size; i++) {
		/*Comprueba que el carácter seleccionado de campo no es un carácter especial, si es así muestra un mensaje de error y retorna false */
		if (/[^!"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~ñáéíóúÑÁÉÍÓÚüÜ ]/.test(campo.value.charAt(i))) {
			msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" contiene algún carácter no válido: "];?>' + campo.value.charAt(i));
			campo.focus();
			return false;
		}
	}

	return true;
}
/*
	function comprobarAlfabetico(campo,size): realiza una comprobación de si el campo contiene letras minúsculas o mayúsculas (los espacios también están incluidos).
*/
function comprobarAlfabetico(campo, size) {
	var i; //variable auxiliar de control
	/*Estructura que permite recorrer todos los caracteres del valor de campo */
	for (i = 0; i < size; i++) {
		/*Comprueba que el carácter seleccionado de campo no es una letra o un espacio, si es así se muestra un mensaje de error y retorna false */
		if (/[^A-Za-zñáéíóúÑÁÉÍÓÚüÜ -]/.test(campo.value.charAt(i))) {
			msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" solo admite carácteres alfabéticos"];?>');
			campo.focus();
			return false;
		}
	}
	return true;
}
/*
	function comprobarCampoNumFormSearch(campo,size,valormenor,valormayor): realiza una comprobación de si el contenido de un campo numérico de un 
	formulario de búsqueda es correcto.
*/
function comprobarCampoNumFormSearch(campo, size, valormenor, valormayor) {

	/*Si el campo es nulo, tiene longitud 0 o está compuesto por espacios en blanco, se retorna true. Si no es así se valida el campo*/
	if (campo.value == null || campo.value.length == 0 || /^\s+$/.test(campo.value)) {
		return true;
	} else {
		/*Comprueba que el campo no tenga una longitud mayor que el indicado por size, si la supera, se retorna false*/
		if (!comprobarLongitud(campo, size)) {
			return false;
		} else {
			/*Comprueba que el campo no contenga carácteres especiales, si no es así, se retorna false */
			if (!comprobarTexto(campo, size)) {
				return false;
			} else {
				/*Comprueba que el campo es un dígito y es mayor que valormenor y es menor que valormayor, si no es así, se retorna false */
				if (!comprobarEntero(campo, valormenor, valormayor)) {
					return false;
				}
			}
		}
	}

	return true;
}
/*
	function comprobarEntero(campo,valormenor,valormayor): realiza una comprobación de que el campo sea entero. Si es así comprueba que es un número
	comprendido entre el valormenor y valormayor
*/
function comprobarEntero(campo, valormenor, valormayor) {

	/*Comprueba que campo es un dígito*/
	if (!/^([0-9])*$/.test(campo.value)) {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene que ser un dígito"];?>');
		campo.focus();
		return false;
	} else {
		/*Comprueba que el valor de campo es mayor que valormayor, si es así muestra un mensaje de error y retorna false */
		if (campo.value > valormayor) {
			msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede ser mayor que "];?>' + valormayor);
			campo.focus();
			return false;
		} else {
			/*Comprueba que el valor de campo es menor que valormenor, si es así muestra un mensaje de error y retorna false */
			if (campo.value < valormenor) {
				msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede ser menor que "];?>' + valormenor);
				campo.focus();
				return false;
			}
		}
	}

	return true;
}
/*
	function comprobarReal(campo,numeroDecimales,valormenor,valormayor): realiza una comprobación
	de que el número introducido en este caso llamado num, tenga el mismo número de decimales que
	el parámetro numeroDecimales y sea menor que el valormayor y mayor que el valormenor.
 */
function comprobarReal(campo, numeroDecimales, valormenor, valormayor) {

	var num; //variable que representa el número del valor de campo
	var i; //variable de control de bucle
	var j; //variable de control de bucle
	var control; //variable de control de bucle
	var numeroDecimalesCampo; //variable que representa el número de decimales del valor de campo
	num = campo.value;
	i = 0;
	j = 0;
	numeroDecimalesCampo = 0;
	control = true;
	/*Comprueba que el formato del valor del campo se corresponde con el formato indicado con la expresión regular */
	if (!(/^-?[0-9]+([,\.][0-9]*)?$/.test(num))) {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene un formato no válido"];?>');
		campo.focus();
		return false;
	} else {
		/*Recorre el valor de campo hasta que control sea falso o la variable de de control i sobrepase la longitud de campo*/
		do {
			/*Comprueba si el caracter seleccionado es un punto o una coma, si es así cuenta los carácteres que le siguen*/
			if (num.charAt(i) == ',' || num.charAt(i) == '.') {
				control = false;
				i++;
				/*Recorre el valor del campo hasta que se sobrepase, mientras aumenta el contador de caracteres encontrados despues del punto y a coma*/
				for (j = i; j < num.length; j++) {
					numeroDecimalesCampo++;
				}
			}
			i++;
		} while (control && (i < num.length));
		/*Comprueba que si el numero de decimales del campo es mayor que el numeroDecimales establecido, muestra un mensaje de error y retorna false*/
		if (numeroDecimalesCampo > numeroDecimales) {
			msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede tener más de "];?>' + numeroDecimales);
			campo.focus();
			return false;
		} else {
			/*Comprueba que el valor de campo es mayor que valormayor, si es así muestra un mensaje de error y retorna false */
			if (num > valormayor) {
				msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede ser mayor que "];?>' + valormayor);
				campo.focus();
				return false;
			} else {
				/*Comprueba que el valor de campo es menor que valormenor, si es así muestra un mensaje de error y retorna false */
				if (num < valormenor) {
					msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" no puede ser menor que "];?>' + valormenor);
					campo.focus();
					return false;
				}
			}
		}
		return true;
	}
}
/*
	comprobarDni(campo): realiza la comprobación de que el valor de campo tenga formato de DNI
*/
function comprobarDni(campo) {
	var numero; //variable que representa la parte numérica del dni
	var letr; //variable que representa la letra del dni
	var letra; //variable que representa el array que permite averiguar la letra del dni
	var expresion_regular_dni; //variable que representa la expresión regular del dni
	letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
	expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

	/*Comprueba si la expresión regular coincide con el formato del valor del campo, si no coincide se muestra un mensaje de error y retorna false*/
	if (expresion_regular_dni.test(campo.value)) {
		numero = campo.value.substr(0, 8);
		letr = campo.value.substr(8, 1);
		numero = numero % 23;
		letra = letra.substring(numero, numero + 1);
		/*Valida que la letra introducida en la variable campo sea correcta, si es así se devuelve devuelve true. Si no, muestra un mensaje de error y devuelve false*/
		if (letra != letr.toUpperCase()) {
			msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene un formato erróneo, la letra del NIF no se corresponde"];?>');
			campo.focus();
			return false;
		} else {
			return true;
		}
	} else {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene un formato erróneo"];?>');
		campo.focus();
		return false;
	}
}
/*
	function comprobarTelf(campo): realiza la comprobación de que el valor de campo tenga el formato de teléfono español, tanto para nacional como internacional
*/
function comprobarTelf(campo) {
	/*Si el valor del campo no cumple el formato de la expresión, se muestra un mensaje de error y se retorna false*/
	if (!/^(34)?[6|7|9][0-9]{8}$/.test(campo.value)) {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene un formato erróneo"];?>');
		campo.focus();
		return false;
	}
	return true;
}
/*
	function comprobarEmail(campo): realiza la comprobación de que campo tenga el formato correcto de una dirección de correo
*/
function comprobarEmail(campo) {
	//Si el valor del campo no cumple el formato de la dirección de correo determinada por la expresión regular, muetra un mensaje de error y retorna false.
	if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(campo.value)) {
		msgError('<?php echo $strings["El atributo "];?>' + atributo[campo.name] + '<?php echo $strings[" tiene un formato erróneo"];?>');
		campo.focus();
		return false;
	}
	return true;
}
/*
	function abrirVentana(): realiza la función de abrir una ventana emergente, a través de una capa, capaFondo1, para que no se pueda interacionar con la capa base. Estas dos capas se activan y su visibility pasa a visible.
*/
function abrirVentana() {
	document.getElementById("capaFondo1").style.visibility = "visible";
	document.getElementById("capaVentana").style.visibility = "visible";
	document.formError.bAceptar.focus();
}
/*
	function cerrarVentana(): realiza la función de cerrar una ventana emergente, a través de una capa, capaFondo1, para que no se pueda interacionar con la capa base. Estas dos capas se desactivas y su visibility pasa a hidden.
*/
function cerrarVentana() {
	document.getElementById("capaFondo1").style.visibility = "hidden";
	document.getElementById("capaVentana").style.visibility = "hidden";
	document.formError.bAceptar.blur();
}
/*
	msgError(msg): realiza la función de mostrar el valor del parámetro msg en el div, cuyo id es "miDiv". Además se encarga de llamar a la función abrirVentana(), la cual muestra un mensaje de error cuya información está en html
*/
function msgError(msg) {

	var miDiv = document.getElementById("miDiv"); // Cogemos la referencia al nuestro div.
	var html = ""; //En esta variable guardamos lo que queramos añadir al div.

	miDiv.innerHTML = ""; //innerHTML te añade código a lo que ya haya por eso primero lo ponemos en blanco.
	html = msg;
	miDiv.innerHTML = html;
	abrirVentana();
	return true;
}
/*
	function comprobarAdd():valida todos los campos del formulario add antes de realizar el submit
*/
function comprobarAdd() {

	var login; /*variable que representa el elemento login del formulario add */
	var pwd; /*variable que representa el elemento password del formulario add */
	var dni; /*variable que representa el elemento dni del formulario add */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario add */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario add */
	var telefono; /*variable que representa el elemento telefono del formulario add */
	var emailuser; /*variable que representa el elemento emailuser del formulario add */
	var fechnacuser; /*variable que representa el elemento fechnacuser del formulario add */
	var fotoPersonal; /*variable que representa el elemento foto personal del formulario add */
	var sexo; /*variable que representa el elemento sexo del formulario add */


	login = document.forms['ADD'].elements[0];
	pwd = document.forms['ADD'].elements[1];
	dni = document.forms['ADD'].elements[2];
	nombreuser = document.forms['ADD'].elements[3];
	apellidosuser = document.forms['ADD'].elements[4];
	telefono = document.forms['ADD'].elements[5];
	emailuser = document.forms['ADD'].elements[6];
	fechnacuser = document.forms['ADD'].elements[7];
	fotoPersonal = document.forms['ADD'].elements[8];
	sexo = document.forms['ADD'].elements[9];


	/*Comprueba si login es vacio, retorna false*/
	if (!comprobarVacio(login)) {
		return false;
	} else {
		/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(login, 15)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(login, 15)) {
				return false;
			}
		}
	}
	/*Comprueba si password es vacio, retorna false*/
	if (!comprobarVacio(pwd)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 20, retorna false*/
		if (!comprobarLongitud(pwd, 20)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(pwd, 20)) {
				return false;
			}
		}
	}
	/*Comprueba si dni es vacio, retorna false*/
	if (!comprobarVacio(dni)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 9, retorna false*/
		if (!comprobarLongitud(dni, 9)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(dni, 9)) {
				return false;
			} else {
				/*Comprueba si tiene un formato valido de dni */
				if (!comprobarDni(dni)) {
					return false;
				}
			}
		}
	}
	/*Comprueba si nombreuser es vacio, retorna false*/
	if (!comprobarVacio(nombreuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 30, retorna false*/
		if (!comprobarLongitud(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(nombreuser, 30)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(nombreuser, 30)) {
					return false;
				}
			}

		}
	}
	/*Comprueba si apellidosuser es vacio, retorna false*/
	if (!comprobarVacio(apellidosuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 50, retorna false*/
		if (!comprobarLongitud(apellidosuser, 50)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(apellidosuser, 50)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(apellidosuser, 50)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si telelefono es vacio, retorna false*/
	if (!comprobarVacio(telefono)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 11, retorna false*/
		if (!comprobarLongitud(telefono, 11)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(telefono, 11)) {
				return false;
			} else {
				/*Comprueba si el formato no es correcto, si es así, retorna false */
				if (!comprobarTelf(telefono)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si emailuser es vacio, retorna false*/
	if (!comprobarVacio(emailuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 60, retorna false*/
		if (!comprobarLongitud(emailuser, 60)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(emailuser, 60)) {
				return false;
			} else {
				/*Comprueba si tiene su formato incorrecto, si es así, retorna false*/
				if (!comprobarEmail(emailuser)) {
					return false;
				}
			}
		}
	}
	/*Comprueba si  fechnacuser es vacio, retorna false*/
	if (!comprobarVacio(fechnacuser)) {
		return false;
	}
	/*Comprueba si fotoPersonal es vacio, retorna false*/
	if (!comprobarVacio(fotoPersonal)) {
		return false;
	}
	/*Comprueba si sexo es vacio, retorna false*/
	if (!comprobarVacio(sexo)) {
		return false;
	}

	encriptar();
	return true;
}
/*
	function comprobarSearch():valida todos los campos del formulario search antes de realizar el submit
*/
function comprobarSearch() {


	var login; /*variable que representa el elemento login del formulario search*/
	var pwd; /*variable que representa el elemento password del formulario search*/
	var dni; /*variable que representa el elemento dni del formulario search */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario search */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario search */
	var telefono; /*variable que representa el elemento telefono del formulario search */
	var emailuser; /*variable que representa el elemento emailuser del formulario search */


	login = document.forms['SEARCH'].elements[0];
	pwd = document.forms['SEARCH'].elements[1];
	dni = document.forms['SEARCH'].elements[2];
	nombreuser = document.forms['SEARCH'].elements[3];
	apellidosuser = document.forms['SEARCH'].elements[4];
	telefono = document.forms['SEARCH'].elements[5];
	emailuser = document.forms['SEARCH'].elements[6];

	/*Comprueba la longitud que tiene login, si es mayor que 15, retorna false*/
	if (!comprobarLongitud(login, 15)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(login, 15)) {
			return false;
		}
	}
	/*Comprueba la longitud que tiene pwd, si es mayor que 128, retorna false*/
	if (!comprobarLongitud(pwd, 128)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(pwd, 128)) {
			return false;
		}
	}

	/*Comprueba la longitud que tiene dni, si es mayor que 9, retorna false*/
	if (!comprobarLongitud(dni, 9)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(dni, 9)) {
			return false;
		}
	}
	/*Comprueba la longitud que tiene nombreuser, si es mayor que 30, retorna false*/
	if (!comprobarLongitud(nombreuser, 30)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
			if (!comprobarAlfabetico(nombreuser, 30)) {
				return false;
			}
		}
	}
	/*Comprueba la longitud que tiene apellidosuser, si es mayor que 50, retorna false*/
	if (!comprobarLongitud(apellidosuser, 50)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(apellidosuser, 50)) {
			return false;
		} else {
			/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
			if (!comprobarAlfabetico(apellidosuser, 50)) {
				return false;
			}
		}
	}
	/*Comprueba la longitud que tiene telefono, si es mayor que 11, retorna false*/
	if (!comprobarLongitud(telefono, 11)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(telefono, 11)) {
			return false;
		}
	}
	/*Comprueba la longitud que tiene emailuser, si es mayor que 60, retorna false*/
	if (!comprobarLongitud(emailuser, 60)) {
		return false;
	} else {
		/*Comprueba si tiene caracteres especiales, si es así, retorna false */
		if (!comprobarTexto(emailuser, 60)) {
			return false;
		}
	}
	return true;
}
/*
	function comprobarEdit():valida todos los campos del formulario edit antes de realizar el submit
*/
function comprobarEdit() {

	var login; /*variable que representa el elemento login del formulario edit */
	var pwd; /*variable que representa el elemento password del formulario edit */
	var dni; /*variable que representa el elemento dni del formulario edit */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario edit */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario edit */
	var telefono; /*variable que representa el elemento telefono del formulario edit */
	var emailuser; /*variable que representa el elemento emailuser del formulario edit */
	var fechnacuser; /*variable que representa el elemento fechnacuser del formulario edit */
	var fotoPersonal; /*variable que representa el elemento foto personal del formulario edit */
	var sexo; /*variable que representa el elemento sexo del formulario edit */


	login = document.forms['EDIT'].elements[0];
	pwd = document.forms['EDIT'].elements[1];
	dni = document.forms['EDIT'].elements[2];
	nombreuser = document.forms['EDIT'].elements[3];
	apellidosuser = document.forms['EDIT'].elements[4];
	telefono = document.forms['EDIT'].elements[5];
	emailuser = document.forms['EDIT'].elements[6];
	fechnacuser = document.forms['EDIT'].elements[7];
	fotoPersonal = document.forms['EDIT'].elements[8];
	sexo = document.forms['EDIT'].elements[9];


	/*Comprueba si login es vacio, retorna false*/
	if (!comprobarVacio(login)) {
		return false;
	} else {
		/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(login, 15)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(login, 15)) {
				return false;
			}
		}
	}
	/*Comprueba si password es vacio, retorna false*/
	if (!comprobarVacio(pwd)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 128, retorna false*/
		if (!comprobarLongitud(pwd, 128)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(pwd, 128)) {
				return false;
			}
		}
	}
	/*Comprueba si dni es vacio, retorna false*/
	if (!comprobarVacio(dni)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 9, retorna false*/
		if (!comprobarLongitud(dni, 9)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(dni, 9)) {
				return false;
			} else {
				/*Comprueba si tiene un formato valido de dni */
				if (!comprobarDni(dni)) {
					return false;
				}
			}
		}
	}
	/*Comprueba si nombreuser es vacio, retorna false*/
	if (!comprobarVacio(nombreuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 30, retorna false*/
		if (!comprobarLongitud(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(nombreuser, 30)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(nombreuser, 30)) {
					return false;
				}
			}

		}
	}
	/*Comprueba si apellidosuser es vacio, retorna false*/
	if (!comprobarVacio(apellidosuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 50, retorna false*/
		if (!comprobarLongitud(apellidosuser, 50)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(apellidosuser, 50)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(apellidosuser, 50)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si telelefono es vacio, retorna false*/
	if (!comprobarVacio(telefono)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 11, retorna false*/
		if (!comprobarLongitud(telefono, 11)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(telefono, 11)) {
				return false;
			} else {
				/*Comprueba si tiene un formato incorrecto, si es así, retorna false */
				if (!comprobarTelf(telefono)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si emailuser es vacio, retorna false*/
	if (!comprobarVacio(emailuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 60, retorna false*/
		if (!comprobarLongitud(emailuser, 60)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(emailuser, 60)) {
				return false;
			} else {
				/*Comprueba si tiene su formato incorrecto, si es así, retorna false*/
				if (!comprobarEmail(emailuser)) {
					return false;
				}
			}
		}
	}
	/*Comprueba si el fechnacuser es vacio, retorna false*/
	if (!comprobarVacio(fechnacuser)) {
		return false;
	}

	/*Comprueba si el sexo es vacio, retorna false*/
	if (!comprobarVacio(sexo)) {
		return false;
	}
	encriptar();
	return true;


}
/*
	function comprobarLogin():valida todos los campos del formulario login antes de realizar el submit
*/
function comprobarLogin() {

	var login; /*variable que representa el elemento login del formulario de login */
	var pwd; /*variable que representa el elemento password del formulario de login */

	login = document.forms['Form'].elements[0];
	pwd = document.forms['Form'].elements[1];

	/*Comprueba si el login es vacio, retorna false*/
	if (!comprobarVacio(login)) {
		return false;
	} else {
		/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(login, 15)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(login, 15)) {
				return false;
			}
		}
		/*Comprueba si la password es vacio, retorna false*/
		if (!comprobarVacio(pwd)) {
			return false;
		} else {
			/*Comprueba su longitud, si es mayor que 20, retorna false*/
			if (!comprobarLongitud(pwd, 20)) {
				return false;
			} else {
				/*Comprueba si tiene caracteres especiales, si es así, retorna false */
				if (!comprobarTexto(pwd, 20)) {
					return false;
				}
			}
		}

	}

	encriptar();

	return true;
}
/*
	function comprobarAddLot():valida todos los campos del formulario add antes de realizar el submit
*/
function comprobarAddLot() {

	var email; /*variable que representa el elemento email del formulario add */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario add */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario add */
	var participacion; /*variable que representa el elemento participacion del formulario add */
	var resguardo; /*variable que representa el elemento resguardo del formulario add */
	var ingresado; /*variable que representa el elemento ingresado del formulario add */
	var premiopersonal; /*variable que representa el elemento premio personal del formulario add */
	var pagado; /*variable que representa el elemento pagado del formulario add */


	email = document.forms['ADDLOT'].elements[0];
	nombreuser = document.forms['ADDLOT'].elements[1];
	apellidosuser = document.forms['ADDLOT'].elements[2];
	participacion = document.forms['ADDLOT'].elements[3];
	resguardo = document.forms['ADDLOT'].elements[4];
	ingresado = document.forms['ADDLOT'].elements[5];
	premiopersonal = document.forms['ADDLOT'].elements[6];
	pagado = document.forms['ADDLOT'].elements[7];


	/*Comprueba si login es vacio, retorna false*/
	if (!comprobarVacio(email)) {
		return false;
	} else {
		/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(email, 60)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(email, 60)) {
				return false;
			} else {
				/*Comprueba si tiene su formato incorrecto, si es así, retorna false*/
				if (!comprobarEmail(email)) {
					return false;
			}
		}
	}
	}
	/*Comprueba si nombreuser es vacio, retorna false*/
	if (!comprobarVacio(nombreuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 30, retorna false*/
		if (!comprobarLongitud(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(nombreuser, 30)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(nombreuser, 30)) {
					return false;
				}
			}

		}
	}
	/*Comprueba si apellidosuser es vacio, retorna false*/
	if (!comprobarVacio(apellidosuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 50, retorna false*/
		if (!comprobarLongitud(apellidosuser, 40)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(apellidosuser, 40)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(apellidosuser, 40)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si participacion es vacio, retorna false*/
	if (!comprobarVacio(participacion)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 3, retorna false*/
		if (!comprobarLongitud(participacion, 3)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(participacion, 3)) {
				return false;
			} 
		}
	}
	/*Comprueba si resguardo es vacio, retorna false*/
	if (!comprobarVacio(resguardo)) {
		return false;
	} 
	/*Comprueba si  ingresado es vacio, retorna false*/
	if (!comprobarVacio(ingresado)) {
		return false;
	}
		
	/*Comprueba si premiopersonal es vacio, retorna false*/
	if (!comprobarVacio(premiopersonal)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 6, retorna false*/
		if (!comprobarLongitud(premiopersonal, 6)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(premiopersonal, 6)) {
				return false;
			} 
		}
	}
	/*Comprueba si pagado es vacio, retorna false*/
	if (!comprobarVacio(pagado)) {
		return false;
	}
	return true;
}
	
	
/*
	function comprobarEditLot():valida todos los campos del formulario edit antes de realizar el submit
*/
function comprobarEditLot() {

	var email; /*variable que representa el elemento email del formulario edit */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario edit */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario edit */
	var participacion; /*variable que representa el elemento participacion del formulario edit */
	var resguardo; /*variable que representa el elemento resguardo del formulario edit */
	var ingresado; /*variable que representa el elemento ingresado del formulario edit */
	var premiopersonal; /*variable que representa el elemento premio personal del formulario edit */
	var pagado; /*variable que representa el elemento pagado del formulario edit */


	email = document.forms['EDITLOT'].elements[0];
	nombreuser = document.forms['EDITLOT'].elements[1];
	apellidosuser = document.forms['EDITLOT'].elements[2];
	participacion = document.forms['EDITLOT'].elements[3];
	resguardo = document.forms['EDITLOT'].elements[4];
	ingresado = document.forms['EDITLOT'].elements[5];
	premiopersonal = document.forms['EDITLOT'].elements[6];
	pagado = document.forms['EDITLOT'].elements[7];


	/*Comprueba si login es vacio, retorna false*/
	if (!comprobarVacio(email)) {
		return false;
	} else {
		/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(email, 60)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(email, 60)) {
				return false;
			} else {
				/*Comprueba si tiene su formato incorrecto, si es así, retorna false*/
				if (!comprobarEmail(email)) {
					return false;
			}
		}
	}
	}
	/*Comprueba si nombreuser es vacio, retorna false*/
	if (!comprobarVacio(nombreuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 30, retorna false*/
		if (!comprobarLongitud(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(nombreuser, 30)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(nombreuser, 30)) {
					return false;
				}
			}

		}
	}
	/*Comprueba si apellidosuser es vacio, retorna false*/
	if (!comprobarVacio(apellidosuser)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 50, retorna false*/
		if (!comprobarLongitud(apellidosuser, 40)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(apellidosuser, 40)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(apellidosuser, 40)) {
					return false;
				}

			}
		}
	}
	/*Comprueba si participacion es vacio, retorna false*/
	if (!comprobarVacio(participacion)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 3, retorna false*/
		if (!comprobarLongitud(participacion, 3)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(participacion, 3)) {
				return false;
			} 
		}
	}
	/*Comprueba si resguardo es vacio, retorna false*/
	if (!comprobarVacio(resguardo)) {
		return false;
	} 
	/*Comprueba si  ingresado es vacio, retorna false*/
	if (!comprobarVacio(ingresado)) {
		return false;
	}
		
	/*Comprueba si premiopersonal es vacio, retorna false*/
	if (!comprobarVacio(premiopersonal)) {
		return false;
	} else {
		/*Comprueba su longitud, si es mayor que 6, retorna false*/
		if (!comprobarLongitud(premiopersonal, 6)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(premiopersonal, 6)) {
				return false;
			} 
		}
	}
	/*Comprueba si pagado es vacio, retorna false*/
	if (!comprobarVacio(pagado)) {
		return false;
	}
	return true;
}
	
	
/*
	function comprobarSearchLot():valida todos los campos del formulario search antes de realizar el submit
*/
function comprobarEditLot() {

	var email; /*variable que representa el elemento email del formulario search */
	var nombreuser; /*variable que representa el elemento nombresuser del formulario search */
	var apellidosuser; /*variable que representa el elemento apellidosuser del formulario search */
	var participacion; /*variable que representa el elemento participacion del formulario search */
	var resguardo; /*variable que representa el elemento resguardo del formulario search */
	var ingresado; /*variable que representa el elemento ingresado del formulario search */
	var premiopersonal; /*variable que representa el elemento premio personal del formulario search */
	var pagado; /*variable que representa el elemento pagado del formulario search */


	email = document.forms['SEARCHLOT'].elements[0];
	nombreuser = document.forms['SEARCHLOT'].elements[1];
	apellidosuser = document.forms['SEARCHLOT'].elements[2];
	participacion = document.forms['SEARCHLOT'].elements[3];
	ingresado = document.forms['SEARCHLOT'].elements[4];
	premiopersonal = document.forms['SEARCHLOT'].elements[5];
	pagado = document.forms['SEARCHLOT'].elements[6];


/*Comprobamos su longitud, si es mayor que 15, retorna false*/
		if (!comprobarLongitud(email, 60)) {
			return false;
		} else {
			/*Comprobamos si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(email, 60)) {
				return false;
			} 
		}
/*Comprueba su longitud, si es mayor que 30, retorna false*/
		if (!comprobarLongitud(nombreuser, 30)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(nombreuser, 30)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(nombreuser, 30)) {
					return false;
				}
			}

		}

/*Comprueba su longitud, si es mayor que 50, retorna false*/
		if (!comprobarLongitud(apellidosuser, 40)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(apellidosuser, 40)) {
				return false;
			} else {
				/*Comprueba si tiene carácteres no alfanuméricos, si es así, retorna false */
				if (!comprobarAlfabetico(apellidosuser, 40)) {
					return false;
				}

			}
		}


/*Comprueba su longitud, si es mayor que 3, retorna false*/
		if (!comprobarLongitud(participacion, 3)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(participacion, 3)) {
				return false;
			} 
		}
	
/*Comprueba su longitud, si es mayor que 6, retorna false*/
		if (!comprobarLongitud(premiopersonal, 6)) {
			return false;
		} else {
			/*Comprueba si tiene caracteres especiales, si es así, retorna false */
			if (!comprobarTexto(premiopersonal, 6)) {
				return false;
			} 
		}
	

	return true;
}
	
	
/*
	function encriptar(): encripta en md5 el valor del campo password
*/
function encriptar() {
	document.getElementById('password').value = hex_md5(document.getElementById('password').value);//cambia el valor del campo password introducido por el usuario, 																							   //por el valor de la password encriptada
}

</script>
