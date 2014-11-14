<?php
class Zelataria {
	private $db = null;	
	
	public static $gaitua = true;
	
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
		//if(isset($_GET['erabiltzailea'])) $this->infoaJaso();
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
		if(isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER']; 		// Nondik dator erabiltzailea?
		else $ref = "Inondik";
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
		//perlada hasiera

			$prozesuan_kontsultak = "SELECT s.id_prod id,p.id iz,sum(kantitatea) kant,p.izena izena
									FROM salmentak s JOIN produktu p ON s.id_prod=p.id
									group by id order by kant desc limit 8";
			$erabiltzaile_erosleak = "SELECT distinct id_er as er from salmentak";
			$erosleak = $this->db->query($erabiltzaile_erosleak);
			while($lerroak = $erosleak->fetch_assoc()) {
				$erabiltzaileen_erosketak = "SELECT sum(kantitatea) kant from salmentak where id_er='".$lerroak['er']."'";
				$erosketak = $this->db->query($erabiltzaileen_erosketak)->fetch_object();
				//echo '<script>alert("'.$erosketak->kant.'")</script>';
				$array_erosketak1[$lerroak['er']]=$erosketak->kant;
				asort($array_erosketak1);
				$array_erosketak = array_reverse($array_erosketak1,true);
			}
			$proze = $this->db->query($prozesuan_kontsultak);	
			$prozea = $this->db->query($prozesuan_kontsultak);	
			$prozeak = $this->db->query($prozesuan_kontsultak);	
			$sql1 = "SELECT ip, user_agent, referer, orrialdea, uid, data FROM zelatari";
			$bisitak1 = $this->db->query($sql1);
			$contador=0;
			while($lerro = $bisitak1->fetch_assoc()) {
		
		
			$datuak=explode("?",$lerro['orrialdea']);
			if(isset($datuak[1])){
			$datuak1=explode("&",$datuak[1]);
			if(isset($datuak1[1])){
			if($datuak1[1]=='ekintza=erakutsi'){
			$datuak2=explode("=",$datuak1[0]);
			$arraya[$contador]=$datuak2[1];
			$contador++;
			$bisiten_arraya1=array_count_values($arraya);
			asort($bisiten_arraya1);
			$bisiten_arraya = array_reverse($bisiten_arraya1,true);
			}}
		}

	}
	//nabigatzailea asmatzen
	$zelatari_nav = "SELECT user_agent as us from zelatari;";
	$nav = $this->db->query($zelatari_nav);
	$i=0;
	while($lerroa = $nav->fetch_assoc()) {
	$browser = new Browser($lerroa['us']);
	$pattern = "/(\d+)/";
	$navigatzailea=preg_split($pattern,$browser->getBrowser(), -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$sistema=preg_split($pattern,$browser->getOs(), -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$nabigatzaileak[$i]=$navigatzailea[0];
	$sistemak[$i]=$sistema[0];
	$i++;
}
$sis=array_count_values($sistemak);
$nab=array_count_values($nabigatzaileak);
			//perlada bukaera
		
		$sql = "SELECT ip, user_agent, referer, orrialdea, uid, data FROM zelatari";
		$bisitak = $this->db->query($sql);

		
		include("bistak/kudeatu_stat.php");
	}
}