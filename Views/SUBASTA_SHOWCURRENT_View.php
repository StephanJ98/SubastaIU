<?php
class SUBASTA_SHOWCURRENT {

	function __construct( $lista ) {
		$this->lista = $lista;
		$this->render( $this->lista );
	}

	function render( $lista ) {
		$this->lista = $lista;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="container seccion" >
			<div class="row justify-content-center">
				<h2>
					<?php echo $strings['Vista detallada'];?>
				</h2>
			</div>
			<div class="row justify-content-center">
				<table class="tablaDatos">
					<tr>
						<th>
							<?php echo $strings['Identificador de Subasta'];?>
						</th>
						<td>
							<?php echo $this->lista['idSubasta'] ?>
						</td>
					</tr>
					<tr>
						<th>
							<?php echo $strings['Identificador de Usuario'];?>
						</th>
						<td>
							<?php echo $this->lista['idUser'] ?>
						</td>
					</tr>
					<tr>
						<th>
							<?php echo $strings['Producto'];?>
						</th>
						<td>
							<?php echo $this->lista['producto'] ?>
						</td>
					</tr>
		            <tr>
						<th>
							<?php echo $strings['Info'];?>
						</th>
						<td>
							<?php echo $this->lista['info'] ?>
						</td>
					</tr>
		            <tr>
						<th>
							<?php echo $strings['Es Ciega'];?>
						</th>
						<td>
							<?php echo $this->lista['esCiega'] ?>
						</td>
					</tr>
		            <tr>
						<th>
							<?php echo $strings['Fichero'];?>
						</th>
						<td>
							<a href="<?php echo $this->lista['ficheroSubasta']?>" alt="<?php echo $strings['ficheroSubasta'];?>">
								<?php echo $this->lista['ficheroSubasta']?>
							</a>
						</td>
					</tr>
		            <tr>
		                <th>
		                    <?php echo $strings['Mayor Puja'];?>
		                </th>
		                <td>
		                    <?php echo $this->lista['mayorPuja']?>
		                </td>
		            </tr>
		            <caption style="margin-top:10px;" align="bottom">
						<form action='../Controllers/SUBASTA_Controller.php' method="post">
							<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
						</form>
					</caption>
				</table>
			</div>
		</div>
			<br>
			<br>
<?php
		include '../Views/Footer.php';
	}
}
?>
