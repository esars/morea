<?php
class Kontua {
	
	/*
	 * Kontua klasea
	 * Erabiltzailearen datuak aldatzeaz arduratzen da,
	 * baita historiala erakusteko.. Beste 
	 * klase batzuen modura, handle funtzio bat izango du.
	*/
	
	private $db = null;
	
	public $erroreak = array();
	public $mezuak = array();
	
	public function __construct() {

		$eid = Session::get('id');
		global $eid;

		if(Sartu::barruan()) {
			global $config;

			$this->db = mysqli_connect(	$config["host"],
									   	$config["user"],
									   	$config["pass"],
										$config["izen"])
										or die("Error " . mysqli_error($this->db));
			$param = $_GET['erabid'] ?: 0;
			$aldatu = $_GET['aldatu'] ?: 0;

			if(isset($_POST['jasodut'])) {
					$this->jaso();
			} else {
				$this->handle($param, $aldatu);
			}
		} else {
			$this->erroreak[] = "Ezin izan gara zure kontura sartu.";
		}
	}
	private function handle($uid = null, $aldatu = null) {
		
		//~ KONTROLATZAILEA

		$erab = $this->db->query("SELECT * from erabiltzaile WHERE id='".$eid."';");
		$erabObj = $erab->fetch_object();

		if(isset($_POST['paaldatu']) || isset($_POST['daaldatu'])) {
			if(isset($_POST['paaldatu'])) $this->pasahitzaAldatu(true);
			else $this->kontuaAldatu(true);
		}

		if($eid == $uid && !empty($aldatu)) {

			switch ($aldatu) {
				case 'pasahitza':
					$this->pasahitzaAldatu();
					break;
				case 'datuak':
					$this->kontuaAldatu();
					break;
			}
		}
		else if($eid == $uid || Sartu::adminBarruan()) {
			$this->erabInfo();
		} else {
			$this->erorreak[] = "Ez dauzkazu beharrezko baimenak.";
		}
	}
	private function erabInfo() {
		
		if(Sartu::adminBarruan()) {
			
			/*
			 * Egoera kanpoa erabiltzen dugu salmenta bat iritsi den ala ez determinatzeko.
			 * EGOERA = 1 --> Datubasean erregistratu da eskaera, bidean dago produktua
			 * EGOERA = 0 --> Produktua iritsi da
			*/
			
			$konts = "SELECT id_er,codigo, p.izena iz, p.prezioa pre, kantitatea, data, e.izena eiz
					  FROM salmentak s 
					  JOIN produktu p ON s.id_prod=p.id
					  JOIN erabiltzaile e ON s.id_er=e.id
					  WHERE egoera='0';";
					  
			$prozesuan_kontsulta = "SELECT distinct codigo, id_prod, id_er, p.izena iz, p.prezioa pre, kantitatea, data, e.izena eiz
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
		
		$hist = $this->db->query($konts);
		
		include("bistak/erab.php");
	}
	private function jaso() {
		$eidak = explode(',', $_POST['arraya']);
		$kodigoidak = explode(',', $_POST['arraiaCod']);
		for($i=1;$i<count($eidak);++$i) {
			$sql = "UPDATE salmentak
					SET egoera='0'
					WHERE codigo='".$kodigoidak[$i]."';";
			echo $sql;
			$q = $this->db->query($sql);
			var_dump($q);
			if(!$q) {
				$this->erroreak[] = "Erroreak kontsultan";
			}
					
		}
	}
	private function pasahitzaAldatu($eginda = false) {
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
		
		} else {
			include('bistak/pasahitza_aldatu.php');
		}
	}
	private function kontuaAldatu($eginda = false) {

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
				$sql = "UPDATE erabiltzaile SET izena='".$izen."',email='".$mail."',abizena='".$abiz."',helbidea='".$helb."',telefonoa='".$telf."'
						WHERE id='".$eid."';";
				$aldatu = $this->db->query($sql);

				if ($aldatu) {
					$this->mezuak[] = "Arrakastaz aldatu duzu zure kontua";

					// REDIRECT

				} else {
					$this->erroreak[] = "Errorea zure datuak aldatzean";
				}
			}

		} else {
			include("bistak/kontua_aldatu.php");
		}
	}
}
