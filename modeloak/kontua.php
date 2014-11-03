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
			$konts = "SELECT produktu.izena Prizena,
							 produktu.prezioa Preezioa, 
							 salmentak.data, 
							 produktu.codigo 
					  FROM salmentak,produktu;";
		} else {
			$konts = "SELECT produktu.izena Prizena,
							 produktu.prezioa Preezioa, 
							 salmentak.data, 
							 produktu.codigo  
					  FROM salmentak,produktu 
					  WHERE salmentak.id_er='".Session::get('id')."';";
		}
		
		$hist = $this->db->query($konts);
		
		$erabObj = $erab->fetch_object();
		
		include("bistak/erab.php");
	}
}
