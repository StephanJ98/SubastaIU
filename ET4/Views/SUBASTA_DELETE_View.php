<?php
class SUBASTA_DELETE {
	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}
	function render( $valores ) {
		$this->valores = $valores;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="container seccion">
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Tabla de borrado'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<table>
					<tr>
						<th>
							<?php echo $strings['Identificador de Subasta'];?>
						</th>
						<td>
							<?php echo $this->valores['idSubasta']?>
						</td>
					</tr>
					<tr>
						<th>
							<?php echo $strings['Identificador de Usuario'];?>
						</th>
						<td>
							<?php echo $this->valores['idUser']?>
						</td>
					</tr>
					<tr>
						<th>
							<?php echo $strings['Producto'];?>
						</th>
						<td>
							<?php echo $this->valores['producto']?>
						</td>
					</tr>
	                <tr>
						<th>
							<?php echo $strings['Info'];?>
						</th>
						<td>
							<?php echo $this->valores['info']?>
						</td>
					</tr>
	                <tr>
						<th>
							<?php echo $strings['Es Ciega'];?>
						</th>
						<td>
							<?php echo $this->valores['esCiega']?>
						</td>
					</tr>
	                <tr>
						<th>
							<?php echo $strings['Fichero'];?>
						</th>
						<td>
							<a href="<?php echo $this->valores['ficheroSubasta']?>" alt="<?php echo $strings['ficheroSubasta'];?>">
									<?php echo $this->valores['ficheroSubasta']?></a>
							</a>
						</td>
					</tr>
	                <tr>
	                    <th>
	                        <?php echo $strings['Mayor Puja'];?>
	                    </th>
	                    <td>
	                        <?php echo $this->valores['mayorPuja']?>
	                    </td>
	                </tr>
				</table>
				<form action="../Controllers/SUBASTA_Controller.php" method="post" style="display: inline-block;">
					<input type="hidden" name="idSubasta" value=<?php echo $this->valores['idSubasta'] ?> />
					<input type="hidden" name="idUser" value=<?php echo $this->valores['idUser'] ?> />
					<input type="hidden" name="producto" value=<?php echo $this->valores['producto'] ?> />
					<input type="hidden" name="info" value=<?php echo $this->valores['info'] ?> />
					<input type="hidden" name="esCiega" value=<?php echo $this->valores['esCiega'] ?> />
					<input type="hidden" name="ficheroSubasta" value=<?php echo $this->valores['ficheroSubasta'] ?> />
					<input type="hidden" name="mayorPuja" value=<?php echo $this->valores['mayorPuja'] ?> />
					<button type="submit" name="action" value="DELETE"><img src="../Views/icon/confirmar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
				</form>
			</div>
			<div class="row justify-content-center">
				<form action='../Controllers/SUBASTA_Controller.php' method="post" style="display: inline">
					<button type="submit"><img src="../Views/icon/cancelar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
					<br>
					<p>
					<?php echo $strings['¿Está seguro de que quiere borrar esta tupla de la tabla?'];?>
					</p>
				</form>
			</div>
		</div>
		<br>
		<br>
<?php
	include '../Views/Footer.php';
	}
}
?>