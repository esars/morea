<?php
class Kontua {
	private $db = null;
	public $mezuak = array();
	public $erroreak = array();

	public function __construct() {
		$erabid = Session::get('id');
		if(Sartu::barruan()) {
			$this->db = mysqli_connect(	$config["host"],
							$config["user"],
							$config["pass"],
							$config["izen"])
							or die("Error " . mysqli_error($this->db));
			
			if(isset($_POST['kontualdatu'])) {
				if(isset($_POST['pasahitzaharra'])) {
					$this->pasahitzaAldatu(true);
				} else {
					$this->kontuaAldatu(true);
				}
			} else if(isset($_GET['aldatu'])) {
				if($_GET['aldatu' == "datuak"]) {
					$this->kontuaAldatu(false);					
				} else {
					$this->pasahitzaAldatu(false);
				}
			} else if(isset($_GET['erabid'])){
				$this->erabInfo();
			}
		} else {
			$this-erroreak[] = "Ez zaude erabiltzaile bezala sartuta.";
		}	
	}	
	private function pasahitzaAldatu($pasata = false) {

	}
	private function kontuaAldatu($pasata = false) {

	}
	private function erabInfo() {
		
		/*
		 * Egoera kanpoa erabiltzen dugu salmenta bat iritsi den ala ez determinatzeko.
		 * EGOERA = 0 --> Produktua iritsi da
		 * EGOERA = 1 --> Datubasean erregistratu da eskaera, bidean dago produktua
		*/
		
	if(Sartu::adminBarruan()) {
		
		$konts = "SELECT id_er,codigo, p.izena iz, p.prezioa pre, kantitatea, data, e.izena eiz
				  FROM salmentak s 
				  JOIN produktu p ON s.id_prod=p.id
				  JOIN erabiltzaile e ON s.id_er=e.id
				  WHERE egoera='0';";
				  
		$prozesuan_kontsulta = "SELECT id_er,codigo, id_prod, id_er, p.izena iz, p.prezioa pre, kantitatea, data, e.izena eiz
								FROM salmentak s 
								JOIN produktu p ON s.id_prod=p.id
								JOIN erabiltzaile e ON s.id_er=e.id
								WHERE egoera='1';";
		$proz = $this->db->query($prozesuan_kontsulta);						

		} else {

			$konts = "SELECT p.izena iz, p.prezioa pre, codigo, kantitatea, data
					  FROM salmentak s JOIN produktu p
					  ON s.id_prod=p.id
					  WHERE id_er=".$eid.";";
		}
	}
}
