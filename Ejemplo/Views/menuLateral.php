<!--Creado el 19 de noviembre del 2018 por cvy3ms/-->
<!--Contiene la vista del menu lateral-->
    <script type="text/javascript" src="../Views/js/desplegarMenu.js"></script> 
	<link href="https://fonts.googleapis.com/css?family=Raleway:200,400,600" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript">
	</script>
	<link href="../Views/css/estiloFinal.css" rel="stylesheet" type="text/css">

		<nav id="menujq">
			<ul>
				<!--Diferentes opciones de la lista y sus links-->

				<li>
					<a href="../Controllers/usuarios_Controller.php?action=ADD"><?php echo $strings['usuarios']; ?></a>

					<ul>
						<li>
							<a href="../Controllers/usuarios_Controller.php?action=ADD"><?php echo $strings['Insertar Usuario']; ?></a>
						</li>


						<li>
							<a href="../Controllers/usuarios_Controller.php?action=SEARCH"><?php echo $strings['Buscar Usuario']; ?></a>
						</li>

					</ul>
				</li>


				<li>
					<a href="../Controllers/usuarios_Controller.php"><?php echo $strings['Mostrar Usuarios']; ?></a>
				</li>


				<li>
					<a href="../Controllers/loteria_Controller.php?action=ADD"><?php echo $strings['loteriaAdd']; ?></a>

					<ul>
						<li>
							<a href="../Controllers/loteria_Controller.php?action=ADD"><?php echo $strings['Insertar loteria']; ?></a>
						</li>


						<li>
							<a href="../Controllers/loteria_Controller.php?action=SEARCH"><?php echo $strings['Buscar loteria']; ?></a>
						</li>

					</ul>
				</li>


				<li>
					<a href="../Controllers/loteria_Controller.php"><?php echo $strings['Mostrar Loterias']; ?></a>
				</li>

			</ul>
		</nav>
                