<?php
/*
	Autor: 	GUI
	Fecha de creación: 05/01/2019 
	Función: contiene todas las características del footer
*/
?>
	<footer><?php echo date("d-M-Y", time()); ?></br><?php if (IsAuthenticated()){  echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>'; }?></footer>
 	</body>
</html>
