<?php

class Sartu {
	private $db = null;
	
	public $erroreak = array();
	public $mezuak = array();
	
	public function __construct() {
		session_start();
		if (isset($_GET["logout"])) {
			$this->atera();
		}
		elseif (isset($_POST["login"])) {
			$this->sartu();
		}
	}
	private function sartu() {
		if(empty($_POST['izena'])) {
			$this->erroreak[] = "Ez duzu erabiltzaile izena jarri.";
		} elseif(empty($_POST['pasahitza'])) {
			$this->erroreak[] = "Ez duzu pasahitza jarri.";
		} elseif(!empty($_POST['izena']) && !empty($_POST['pasahitza'])) {
			$this->db = new mysqli_connect($config["host"], 
																		 $config["user"],
																		 $config["pass"],
																		 $config["izen"]);
			
			if(!$this->db->connect_errno) {
				$izena = $this->db->real_escape_string($_POST['izena']);
				$sql = "SELECT user_name, user_email, user_password_hash
						FROM erabiltzaile
						WHERE user_name = '" . $izena . "' OR user_email = '" . $izena . "';";
				$existitzenbada = $this->db->query($sql);
				if($existitzenbada->num_rows == 1) {
					
					//Konsulta batetikan emaitza bat bueltatzen bada hau objektu dinamikoan ahal degu bihurtu funtzio honekin
					
					$emaitza = $existitzenbada->fetch_object();
					
					/*
					 * Inputeko pasahitza hartu, datubasetik erabiltzailearen
					 * salta lortu, bata besteari gehitu, enkriptatu konbinazioa
					 * eta datubasean dagoenarekin alderatu
					*/ 
					
					if(password_verify($_POST['pasahitza'].$emaitza->salt, $emaitza->pasahitza)) {
						$_SESSION['emaila'] = $emaitza->email;
						$_SESSION['izena'] = $emaitza->izena;
					} else {
						$this->erroreak = "Pasahitz okerra";
					}
				} else {
					$this->erroreak[] = "Izen edo email hori ez da existitzen.";
				}
			}
			
			
		}
	}
	private function atera() {
		session_destroy();
	}
	public static function barruan() {
		if(isset($_SESSION['izena'])) {
			return true;
		} else {
			return false;
		}
	}
	public static function adminBarruan() {
		if($_SESSION['izena'] == "admin") {
				return true;
		} else {
				return false;
		}
	}
}
