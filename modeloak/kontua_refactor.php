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
			$this->erroreak[] = "Ez zaude erabiltzaile bezala sartuta.";
		}	
	}	
	private function pasahitzaAldatu($pasata = false) {

		include("bistak/pasahitza_aldatu.php");
		if($eginda) {

				$p1 = $_POST['pasahitzaharra'];
				$pb1 = $_POST['pasahitzberri1'];
				$pb2 = $_POST['pasahitzberri2'];

				if(empty($p1) || empty($pb1) || empty($pb2)) {
					$this->erroreak[] = "Pasahitzen bat hutsik utzi duzu.";
				} else if($pb1 !== $pb2) {
					$this->erroreak[] = "Pasahitzak desberdinak ziren";
				} else if(!password_verify($p1.$erabObj->pasahitza_salt, $erabObj->pasahitza_hash)) {
					$this->erroreak[] = "Sartu duzun pasahitz zaharra okerra zen";
				} else {

					$pass_hash = password_hash($p1.$erabObj->pasahitza_salt, PASSWORD_DEFAULT);

					$aldaketa = $this->db->query("UPDATE erabiltzaile SET pasahitza_hash='".$pass_hash."';");

					if($aldaketa) {
						$this->mezuak[] = "Arrakastaz aldatu duzu pasahitza.";
						// Redirect
					} else {
						$this->erroreak[] = "Errorea pasahitza aldatzean.";
					}
				}
	
		}
	}
	private function kontuaAldatu($pasata = false) {
		
		include("bistak/kontua_aldatu.php");

		if($eginda) {
			$izen = $this->db->real_escape_string(strip_tags($_POST['izena'], ENT_QUOTES));
			$abiz = $this->db->real_escape_string(strip_tags($_POST['abizena'], ENT_QUOTES));
			$mail = $this->db->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
			$helb = $this->db->real_escape_string(strip_tags($_POST['helbidea'], ENT_QUOTES));
			$telf = $_POST['telefono'];

			if(empty($izen)) {
				$this->erroreak[] = "Izena hutsik zegoen";
			} else if(strlen($izen) > 50 || strlen($izen) < 2) {
				$this->erroreak[] = "Izena luzeegia edo motzegia zen";
			} else if(!preg_match('/^[a-z\d]{2,64}$/i', $izen)) {
				$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
			} else if(empty($abiz)) {
				$this->erroreak[] = "Izena hutsik zegoen";
			} else if(strlen($abiz) > 50 || strlen($abiz) < 2) {
				$this->erroreak[] = "Izena luzeegia edo motzegia zen";
			} else if(!preg_match('/^[a-z\d]{2,64}$/i', $abiz)) {
				$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
			} else if(empty($mail)) {
				$this->erroreak[] = "Emaila ezin da hutsik egon";
			} else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$this->erroreak[] = "Emailaren sintaxia ez da egokia";
			} else if(!ctype_digit($telf) || empty($telf)) {
				$this->erroreak[] = "Telefonoa hutsik zegoen edo ez zen numerikoa";
			} else if(strlen($helb) < 5 || strlen($helb) > 50) {
				$this->erroreak[] = "Helbidea luzeegia edo motzegia zen.";
			} else {
				$sql = "UPDATE erabiltzaile SET izena='".$izen."',email='".$mail."',abizena='".$abiz."',helbidea='".$helb."',telefonoa='".$telf."' WHERE id='".$eid."';";
				$aldatu = $this->db->query($sql);

				if ($aldatu) {
					$this->mezuak[] = "Arrakastaz aldatu duzu zure kontua";

					// REDIRECT

				} else {
					$this->erroreak[] = "Errorea zure datuak aldatzean";
				}
			}
		}

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
			
			$hist = $this->db->query();	
			
			include("bistak/erab.php");
	}
}
