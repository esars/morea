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
		if(Sartu::barruan()) {
			global $config;

			$this->db = mysqli_connect(	$config["host"],
									   	$config["user"],
									   	$config["pass"],
										$config["izen"])
										or die("Error " . mysqli_error($this->db));
			$param = $_GET['erabid'];
			if(isset($_POST['jasodut'])) {
					$this->jaso();
			}
			if(isset($param)) {
					$this->handle($param);
			} else {
					$this->erroreak[] = "$_GET 'erabid' aldagaia falta da.";
			}
		} else {
			$this->erroreak[] = "Ezin izan gara zure kontura sartu.";
		}
	}
	private function handle($uid) {
		
		//~ KONTROLATZAILEA
		
		if(Session::get('id') == $uid || Sartu::adminBarruan()) {
			$this->erabInfo();
		} else {
			$this->erorreak[] = "Ez dauzkazu beharrezko baimenak.";
		}
	}
	private function erabInfo() {
		$erab = $this->db->query("SELECT * from erabiltzaile WHERE id='".Session::get('id')."';");
		if(Sartu::adminBarruan()) {
			
			/*
			 * Egoera kanpoa erabiltzen dugu salmenta bat iritsi den ala ez determinatzeko.
			 * EGOERA = 1 --> Datubasean erregistratu da eskaera, bidean dago produktua
			 * EGOERA = 0 --> Produktua iritsi da
			*/
			//$helbidea='localhost:8888/morea/index.php?id=2&ekintza=erakutsi';
			//$datuak=explode("?",$helbidea);
			//$id_ekintza=explode("&",$datuak[1]);
			//echo "<script>alert('id = ".$id_ekintza[0]." ekintza=".$id_ekintza[1]."')</script>";
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
					  WHERE id_er=".Session::get('id').";";
		}
		
		$hist = $this->db->query($konts);
		
		$erabObj = $erab->fetch_object();
		include("bistak/erab.php");
	}
	private function jaso() {
		$idak = explode(',', $_POST['arraya']);
		$kodigoidak = explode(',', $_POST['arraiaCod']);
		for($i=1;$i<count($idak);++$i) {
			$sql = "UPDATE salmentak
					SET egoera='0'
					WHERE codigo='".$kodigoidak[$i]."';";
			//echo $sql;
			$q = $this->db->query($sql);
			//var_dump($q);
			if(!$q) {
				$this->erroreak[] = "Erroreak kontsultan";
			}
					
		}
	}
}
