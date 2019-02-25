<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del footer
*/
?>
		<footer class="container-fluid" id="foot"><?php echo date("d-M-Y", time());?></br>
				<?php if ( IsAuthenticated() ){  
					$sesion = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 'No identificado';
					echo $strings['Usuario'] . ' : ' . $sesion . '<br>'; }?>
		</footer>
		<!-- Et ceux la doivent être a toute fin du <body>. -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 	</body>
</html>