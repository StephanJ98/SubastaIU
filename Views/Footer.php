<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del footer
*/
?>
		<footer><?php echo date("d-M-Y", time());?></br>
				<?php if ( IsAuthenticated() ){  
					$sesion = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 'No identificado';
					echo $strings['Usuario'] . ' : ' . $sesion . '<br>'; }?>
		</footer>
 	</body>
</html>
