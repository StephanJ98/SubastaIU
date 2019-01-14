<?php
//Creado el : 14/1/2019
//Creado por: GUI
class ORIGIN {
	function __construct() {
		$this->render();
	}
	function render() {
		include '../Views/Header.php';
		?>
		<div class="container section">
			<br>
			<br>
			<br>
			<div class="row justify-content-center">
				<form action='../Controllers/USUARIO_Controller.php'>
					<button type="submit" name="action" value="SHOWALL" style="border: none;background-color: #E4E4E4;">
						<div class="col-3" style="height: 50px;">
							<strong><p>Administración</p></strong>
							<img src="../Views/icon/user.png" alt="Administración"  style="height: 80px;" />
						</div>
					</button>
				</form>
				<form action='../Controllers/HISTORIAL_Controller.php'>
					<button type="submit" name="action" value="" style="border: none;background-color: #E4E4E4;">
						<div class="col-3">
							<strong><p>Historial</p></strong>
							<img src="../Views/icon/historial.png" alt="Historial" style="height: 80px;"/>
						</div>
					</button>
				</form>
				<form action='../Controllers/SUBASTA_Controller.php'>
					<button type="submit" name="action" value="" style="border: none;background-color: #E4E4E4;">
						<div class="col-3">
							<strong><p>Subastas</p></strong>
							<img src="../Views/icon/subasta.png" alt="Subastas" style="height: 80px;"/>
						</div>
					</button>
				</form>
				<form action='../Controllers/PUJA_Controller.php'>
					<button type="submit" name="action" value="" style="border: none;background-color: #E4E4E4;">
						<div class="col-3">
							<strong><p>Pujas</p></strong>
							<img src="../Views/icon/subasta.png" alt="Pujas" style="height: 80px;"/>
						</div>
					</button>
				</form>
			</div>
		</div>
<?php
		include '../Views/Footer.php';
	} 
} 
?>