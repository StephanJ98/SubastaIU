<?php
class PUJA_SHOWCURRENT {

	function __construct( $lista ) {
		$this->lista = $lista;
		$this->render( $this->lista );
	}

	function render( $lista ) {
		$this->lista = $lista;
		include '../Locales/' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<h2>
			<?php echo $strings['Vista detallada'];?>
		</h2>
		<table class="tablaDatos">
			<tr>
				<th>
					<?php echo $strings['NombredePuja'];?>
				</th>
				<td>
					<?php echo $this->lista['idPuja']?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo $strings['Id de Subasta'];?>
				</th>
				<td>
					<?php echo $this->lista['IdSubasta'] ?>
				</td>
			</tr>
            <tr>
				<th>
					<?php echo $strings['Nombre de Usuario'];?>
				</th>
				<td>
					<?php echo $this->lista['idUser'] ?>
				</td>
			</tr>
            <tr>
				<th>
					<?php echo $strings['importe'];?>
				</th>
				<td>
					<?php echo $this->lista['importe'] ?>
				</td>
			</tr>

            <caption style="margin-top:10px;" align="bottom">
				<form action='../Controllers/PUJA_CONTROLLER.php' method="post">
					<button type="submit"><img src="../Views/icon/atras.png" alt="<?php echo $strings['Atras'] ?>" /></button>
				</form>
			</caption>
		</table>

<?php
		include '../Views/Footer.php';
	}
}
?>
