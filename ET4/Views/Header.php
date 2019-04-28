<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del header
*/
	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';

	}
	include '../Locales/' . $_SESSION['idioma'] . '.php';
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Ceci doit être le premier css chargé.-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" media="screen" href="../Views/style/index.css" hreflang="es">
	<link rel="stylesheet" type="text/css" media="screen" href="../Views/tcal/tcal.css" hreflang="es">
	<?php include '../Views/js/validaciones.js' ?>
	<title>Subastas</title>
</head>
<body>
<header class="container" id="head">
	<p style="text-align:center">
		<h1>
<?php
			echo $strings['Portal de Subastas'];
?>
		</h1>
	</p>
<?php	
	if (IsAuthenticated()){
?>
		<br>
		<p style="font-size:20px; ">
<?php
			$sesion = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 'No identificado';
			$tipo = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'Sin Rol Asignado';
			echo $strings['Usuario'] . ' : ' . $sesion . '&nbsp&nbsp&nbsp&nbsp';
			if ($tipo == 0) {
				$texto = $strings['Administrador'];
			}
			elseif ($tipo == 1) {
				$texto = $strings['Pujador'];
			}
			else{
				$texto = $strings['Subastador'];
			}
			echo $strings['Rol'] . ' : ' . $texto . '<br>';
?>	
			<a href="../Functions/Desconectar.php" style="text-decoration:none"> <img src="../Views/icon/desconexion.png" width="32" height="32" alt="<?php echo $strings['Desconectarse']?>" style="float:right;"></a>
	
		</p>
<?php
	} else {
		
		echo $strings['Usuario no identificado'];
?> 
		<a href = '../Controllers/Register_Controller.php' ><img src="../Views/icon/registrarse.png" alt="<?php echo $strings['Registrar']?>" /></a>
<?php		
	}
?>
	<form name='idiomform' action="../Functions/CambioIdioma.php" method="post">
		<?php echo $strings['idioma']; ?>
		<button type="submit"  name="idioma" value="FRANCAIS" ><img src="../Views/icon/france.png" alt="<?php echo $strings['Cambiar idioma a español']?>" width="32" height="20" style="display: block;"/></button>
		<button type="submit"  name="idioma" value="SPANISH" ><img src="../Views/icon/banderaEspaña.jpg" alt="<?php echo $strings['Cambiar idioma a español']?>" width="32" height="20" style="display: block;"/></button>
		<button type="submit"  name="idioma" value="ENGLISH" ><img src="../Views/icon/banderaReinoUnido.png" alt="<?php echo $strings['Cambiar idioma a inglés']?>" width="32" height="20" style="display: block;"/></button>
		<button type="submit"  name="idioma" value="GALLAECIAN" ><img src="../Views/icon/banderaGalicia.png" alt="<?php echo $strings['Cambiar idioma a gallego']?>" width="32" height="20" style="display: block;"/></button>
	</form>	
	<div class="row">
		<?php
		if (IsAuthenticated()){
			?>
			<div class="col">
			<a href="../Controllers/USUARIO_Controller.php"><?php echo $strings['Inicio'];?></a>
			</div>
		
		<div class="col">
			<a href="../Controllers/SUBASTA_Controller.php"><?php echo $strings['Subastas'];?></a>
		</div>
		<div class="col">
			<a href="../Controllers/PUJA_Controller.php"><?php echo $strings['Pujas'];?></a>
		</div>
			<?php
		}
		?>
		<?php
		if (IsAuthenticated() && $_SESSION['rol'] == 0){
			?>
			<div class="col">
			<a href="../Controllers/HISTORIAL_Controller.php"><?php echo $strings['Historial'];?></a>
			</div>
			<?php
		}
		?>
	</div>
</header>