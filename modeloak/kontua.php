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
	private function datuakAldatu() {
		
	}
	private function pasahitzaAldatu() {
		
	}
	private function kontuaBorratu() {
		
	}
	private function kontuakKudeatu() {
		
	}
	private function erabInfo() {
		$erab = $this->db->query("SELECT * from erabiltzaile WHERE id='".Session::get('id')."';");
		
		if(Sartu::adminBarruan()) {
			$konts = "SELECT id_er,codigo, p.izena iz, p.prezioa pre, kantitatea, data, e.izena eiz
					  FROM salmentak s JOIN produktu p ON s.id_prod=p.id
									   JOIN erabiltzaile e ON s.id_er=e.id;";
		} else {
			$konts = "SELECT p.izena iz, p.prezioa pre, codigo, kantitatea, data
					  FROM salmentak s JOIN produktu p
					  ON s.id_prod=p.id
					  WHERE id_er=".Session::get('id').";";
		}
		
		$hist = $this->db->query($konts);
		
		$erabObj = $erab->fetch_object();
		var_dump($hist);
		include("bistak/erab.php");
	}
}
