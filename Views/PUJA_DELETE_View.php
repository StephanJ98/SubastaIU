<?php
class PUJA_DELETE {

	function __construct( $valores ) {
		$this->valores = $valores;
		$this->render( $this->valores );
	}

	function render( $valores ) {
		$this->valores = $valores;
		include '../Locales/Strings_' . $_SESSION[ 'idioma' ] . '.php';
		include '../Views/Header.php';
?>
		<div class="seccion">
			<h2>
				<?php echo $strings['Tabla de borrado'];?>
			</h2>
			<table>
				<tr>
					<th>
						<?php echo $strings['Nombre de Usuario de Puja'];?>
					</th>
					<td>
						<?php echo $this->valores['idPUJA']?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo $strings['iD subasta'];?>
					</th>
					<td>
						<?php echo $this->valores['id_Subasta']?>
					</td>
				</tr>
                <tr>
					<th>
						<?php echo $strings['Nombre de Usuario de Usuario'];?>
					</th>
					<td>
						<?php echo $this->valores['Id User']?>
					</td>
				</tr>
                <tr>
					<th>
						<?php echo $strings['Importe'];?>
					</th>
					<td>
						<?php echo $this->valores['Importe']?>
					</td>
				</tr>
                
                <tr>
                    <th>
                        <?php echo $strings['Rol'];?>
                    </th>
                    <td>
                        <?php echo $this->valores['userRol']?>
                    </td>
                </tr>
                <p style="text-align:center;">
				<?php echo $strings['¿Está seguro de que quiere borrar esta tupla de la tabla?'];?>
			</p>
			<form action="../Controllers/PUJA_CONTROLLER.php" method="post" style="display: inline">
				<input type="hidden" name="idPUJA" value=<?php echo $this->valores['idPuja'] ?> />
				<input type="hidden" name="ID_Subasta" value=<?php echo $this->valores['ID_Subasta'] ?> />
				<input type="hidden" name="Nombre de Usuario" value=<?php echo $this->valores['Nombre de Usuario'] ?> />
				<input type="hidden" name="Importe" value=<?php echo $this->valores['Importe'] ?> />
				<button type="submit" name="action" value="DELETE"><img src="../Views/icon/confirmar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
			<form action='../Controllers/PUJA_CONTROLLER.php' method="post" style="display: inline">
				<button type="submit"><img src="../Views/icon/cancelar.png" alt="<?php echo $strings['Atras'] ?>"/></button>
			</form>
		</div>
<?php
		include '../Views/Footer.php';
	}
}

?>