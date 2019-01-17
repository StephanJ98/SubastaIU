<!--Archivo php
	Nombre: Footer.php
	Autor: cvy3ms
	Fecha de creación: 23/11/2018 
	Función: contiene todas las características del footer
-->
</article>
 </div>
 <div id="capaVentana" style="visibility: hidden;">
		<table  width="250px" style="border:1px solid red;padding:0px;">
			<tr>
				<td colspan="2" style="background-color:red" width="250px">
						<font style="font-size:24px;color:white"><?php echo $strings['Alerta']?></font>
				</td>
			
			</tr>
			<tr>
				<td colspan="2" style="background-color:white;" >
					<div id="miDiv" style="color:black;"><?php echo $strings['Error:']?></div>
				</td>
			</tr>
			<tr style="background-color:white">
				<td >		
					<form name="formError">
						<button type="button"  name="bAceptar"  value="Aceptar" onclick="cerrarVentana()" ><img src="../Views/icon/confirmar.png" height="32" width="32" alt="<?php echo $strings['Aceptar']?>"  /></button>	
					</form>
				</td>
			</tr>
			
		</table>
</div>
	
<div id="capaFondo1"></div>
	<footer><?php echo date("d-M-Y", mktime()); ?></br><?php if (IsAuthenticated()){  echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>'; }?></footer>
  </body>
</html>
