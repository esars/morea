<?php

class Sartu {
	private $db = null;

	public $erroreak = array();
	public $mezuak = array();

	public function __construct() {
		//session_start();
		if (isset($_POST["logout"])) {
			$this->atera();
		}
		elseif (isset($_POST["login"])) {
			$this->sartu();
		}
	}
	private function sartu() {
		if(empty($_POST['email'])) {
			$this->erroreak[] = "Ez duzu erabiltzaile izena jarri.";
		} elseif(empty($_POST['pasahitza'])) {
			$this->erroreak[] = "Ez duzu pasahitza jarri.";
		} elseif(!empty($_POST['email']) && !empty($_POST['pasahitza'])) {
			global $config;
			$this->db = mysqli_connect($config["host"],
																		 $config["user"],
																		 $config["pass"],
																		 $config["izen"]);

			if(!$this->db->connect_errno) {
				$izena = $this->db->real_escape_string($_POST['email']);
				$sql = "SELECT izena, email, pasahitza_hash, pasahitza_salt
						FROM erabiltzaile
						WHERE izena = '" . $izena . "' OR email = '" . $izena . "';";
				$existitzenbada = $this->db->query($sql);
				if($existitzenbada->num_rows != 0) {

					//Konsulta batetikan emaitza bat bueltatzen bada hau objektu dinamikoan ahal degu bihurtu funtzio honekin

					$emaitza = $existitzenbada->fetch_object();

					/*
					 * Inputeko pasahitza hartu, datubasetik erabiltzailearen
					 * salta lortu, bata besteari gehitu, enkriptatu konbinazioa
					 * eta datubasean dagoenarekin alderatu
					*/
					if(password_verify($_POST['pasahitza'].$emaitza->pasahitza_salt, $emaitza->pasahitza_hash)) {
						Session::set('email', $emaitza->email);
						Session::set('izena', $emaitza->izena);
						$this->mezuak[] = "Egunon, ".Session::get('izena');
					} else {
						$this->erroreak[] = "Pasahitz okerra";
					}
				} else {
					$this->erroreak[] = "Izen edo email hori ez da existitzen.";
				}
			}


		}
	}
	private function atera() {
		$this->mezuak[] = "Arrakastaz atera zara.";
		Session::saioa_itxi();
		Mugitu::nora('index.php');
	}
	public static function barruan() {
		if(Session::existitzenBada('izena')) {
			return true;
		} else {
			return false;
		}
	}
	public static function adminBarruan() {
		if(Session::existitzenBada('email') && Session::get('email') == "admin@gmail.com") {
				return true;
		} else {
				return false;
		}
	}
}
?>
