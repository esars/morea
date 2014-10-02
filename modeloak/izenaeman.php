<?php

class IzenaEman {
		private $db = null;
	
		public $erroreak = array();
		public $mezuak = array();
		
		public function __construct() {
				if(isset($_POST['izenaeman'])) {
						$this->erregistratu();
				} else {
						$this->erroreak[] = "Errore ezezaguna";
				}
		}
		
		private function erregistratu() {
				if(empty($_POST['izena'])) {
						$this->erroreak = "Izena hutsik zegoen";
				} else if(empty($_POST['pasahitza']) OR empty($_POST['pasahitza1'])) {
						$this->erroreak = "Pasahitza hutsik zegoen";
				} else if($_POST['pasahitza'] !== $_POST['pasahitza1']) {
						$this->erroreak = "Pasahitzak desberdinak ziren";
				} else if(strlen($_POST['izena']) > 50 || strlen($_POST['izena']) < 2 {
						$this->erroreak = "Izena luzeegia edo motzegia zen";
				} else if(!preg_match('/^[a-z\d]{2,64}$/i', $_POST['izena'])) {
						$this->erroreak = "Izenean bakarrik hizkiak eta zenbakiak";
				} else if(empty($_POST['email'])) {
						$this->erroreak = "Emaila ezin da hutsik egon";
				} else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						$this->erroreak = "Emailaren sintaxia ez da egokia";
				} 
				
				//	Gauza gehio gehitu behar dira, helbidea, telefonoa... dena luzera minimo baten
				
				else {
						//	DATUAK SARTU	//
						
						$this->db = new mysqli_connect($config["host"], 
																					 $config["user"],
																					 $config["pass"],
																					 $config["izen"]);
						if(!$this->db->connect_errno) {
								
								/*
								 * real_escape_string eta strip_tags HTML eta JS
								 * 'garbitu' egiten ditu kodigoa testu normal
								 * bihurtuz
								*/
								
								$izena = $this->db->real_escape_string(strip_tags($_POST['izena'], ENT_QUOTES));
								$email = $this->db->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
								$helbi = $this->db->real_escape_string(strip_tags($_POST['helbidea'], ENT_QUOTES));
								$pass = $_POST['pasahitza'];
								$telf = $_POST['telefonoa'];
								
								//	password_hash PHP 5.3tik aurrera dabil	//
								
								$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
								
								//	Emaila erabilpenean dagoen konprobatu	//
								
								$sql = "SELECT * FROM erabiltzaile WHERE email='".$email."';";
								$emailaErabilpenean = $this->db->query($sql);
								
								if($emailaErabilpenean->num_rows == 1) {
										$this->erroreak = "Emaila erabilpenean dago";
								} else {
										$sql = "INSERT INTO erabiltzaile
														(izena,)";
								}
						}
				}
		}
}
