<?php
class Zelataria {

	private $db = null;	
	public $erroreak = [];
	public $mezuak = [];
	
	static $gaitua = true;
	
	/*
	 * Zelatariaren modeloa. Adminari orrialdea bisitatzen duten
	 * erabiltzaleei buruzko informazioa jaso eta taula baten 
	 * sartzen du.
	*/
	
	public function __construct() {
		$this->handle(); 
	}
	
	private function handle() {
	
		global $config;
	
		$this->db = mysqli_connect(	$config["host"],
								   	$config["user"],
								   	$config["pass"],
									$config["izen"])
									or die("Error " . mysqli_error($this->db));
									
		if(!Sartu::adminBarruan() && Zelataria::$gaitua) $this->infoaJaso();
		if( Sartu::adminBarruan() && 
			isset($_GET['ekintza']) &&
			$_GET['ekintza'] == "kudeatzaile_stat") $this->estatIkusi();
	}
	private function infoaJaso() {
		
		/*
		 * Hemen erabiltzaileri buruzko informazioa jasoko
		 * dugu, $_SERVER aldagaiak ematen digun informazioaren
		 * bidez.
		*/
		
		// $ipa = $_SERVER['REMOTE_ADDR'];     	// IP helbidea
		$ipa = $this->ipLortu();
		$uag = $_SERVER['HTTP_USER_AGENT']; 	// User agent: nabegadorea, OS...
		$hel = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // Orrialdea
		$ref = $_SERVER['HTTP_REFERER']; 		// Nondik dator erabiltzailea?
		if(Session::existitzenBada('id')) $uid = Session::get('id');
		else $uid = "Gonbidatua";
		$data = date('Y-m-d h:i:s');
		
		$sql = "INSERT INTO zelatari
				(ip, user_agent, referer, orrialdea, uid, data)
				VALUES
				('".$ipa."', '".$uag."', '".$ref."', '".$hel."', '".$uid."', '".$data."');";
		
		$infoaSartu = $this->db->query($sql) or die(mysqli_error($this->db));
		
		if(!$infoaSartu) Session::set('erroreak', 'Errorea zure informazioa jasotzean.');
	}
	
	private function ipLortu() {
		
		/*
		 * Batzutan $_SERVER['REMOTE_ADDR'] aldagaiak balio
		 * okerrak ematen ditu, bezeroa proxy baten bidez
		 * konektatua dagoenean adibidez. Funtzio honek
		 * baliozko IP bat bueltatuko digu, posible badu.
		*/	
		
		$ip = "";
		
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else $ip = $_SERVER['REMOTE_ADDR']; // fallback
		
		return $ip;
	}
	
	private function estatIkusi() {

		$sql = "SELECT ip, user_agent, referer, orrialdea, uid, data FROM zelatari";
		$bisitak = $this->db->query($sql);
		include("bistak/kudeatu_stat.php");
	}
}	
