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
				<form action='../Controllers/PUJA_Controller.php' method="post">
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
			                	<?php
			                	if($lista['esCiega'] == 'true'){
									if ((($_SESSION['rol'] == 0) || ($_SESSION['idUser'] == $lista['idUser']))) {
										echo $this->lista['mayorPuja'];
									}
									else{
										$this->lista['mayorPuja'] = 'X';
									}
								}else{
									echo $this->lista['mayorPuja'];
								}
			                    ?>
			                </td>
			            </tr>
			            <tr>
			            	<th>
			            		<?php echo $strings['Identificador Puja'];?>
			            	</th>
			            	<td>
			            		<input type="text" id="idPuja" name="idPuja" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="30" size = '30' value = ''/>
			            	</td>
			            </tr>
			            <tr>
			            	<th>
			            		<?php echo $strings['Importe'];?>
			            	</th>
			            	<td>
			            		<input type="text" id="importe" name="importe" placeholder="<?php echo $strings['Escriba aqui...']?>" maxlength="10" size = '30' value = ''/>
			            	</td>
			            </tr>
			            <tr>
			            	<th>
			            		<p>&nbsp</p>
			            	</th>
			            	<td>
			            		<?php
			            		$user = $_SESSION['idUser'];
			            		$subast = $this->lista['idSubasta'];
			            		?>
			            		<input type="text" id="idUser" name="idUser" style="display: none;" value="<?php echo $user ?>">
			            		<input type="text" id="idSubasta" name="idSubasta" style="display: none;" value="<?php echo $subast?>">
			            		<button type="submit" name="action" value="ADD"><img src="../Views/icon/añadir.png" alt="AÑADIR" /></button>
			            	</td>
			            </tr>
			            <tr>
				            <td>
					            <div class="row justify-content-center">
						            <caption style="margin-top:10px;" align="bottom">
										<form action='../Controllers/SUBASTA_Controller.php' method="post">
											<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
										</form>
									</caption>
								</div>
							</td>
						</tr>
					</table>
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
