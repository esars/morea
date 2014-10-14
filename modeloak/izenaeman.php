<?php

class IzenaEman {
		private $db = null;

		public $erroreak = array();
		public $mezuak = array();

		public function __construct() {
				if(isset($_POST['izena'])) {
						$this->erregistratu();
				}
		}

		private function erregistratu() {

				//	MINIMOAK ETA KARAKTERE BALIOZKOAK	//

				if(empty($_POST['izena'])) {
						$this->erroreak[] = "Izena hutsik zegoen";
				} else if(empty($_POST['pasahitza1']) OR empty($_POST['pasahitza2'])) {
						$this->erroreak[] = "Pasahitza hutsik zegoen";
				} else if($_POST['pasahitza1'] !== $_POST['pasahitza2']) {
						$this->erroreak[] = "Pasahitzak desberdinak ziren";
				} else if(strlen($_POST['izena']) > 50 || strlen($_POST['izena']) < 2) {
						$this->erroreak[] = "Izena luzeegia edo motzegia zen";
				} else if(!preg_match('/^[a-z\d]{2,64}$/i', $_POST['izena'])) {
						$this->erroreak[] = "Izenean bakarrik hizkiak eta zenbakiak";
				} else if(empty($_POST['email'])) {
						$this->erroreak[] = "Emaila ezin da hutsik egon";
				} else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						$this->erroreak[] = "Emailaren sintaxia ez da egokia";
				} else if(!ctype_digit($_POST['telefono']) || empty($_POST['telefono'])) {
						$this->erroreak[] = "Telefonoa hutsik zegoen edo ez zen numerikoa";
				} else if(strlen($_POST['helbidea']) < 5 || strlen($_POST['helbidea']) > 50) {
						$this->erroreak[] = "Helbidea luzeegia edo motzegia zen.";
				}

				//	Gauza gehio gehitu behar dira, helbidea, telefonoa... dena luzera minimo baten

				else {
						//	DATUAK SARTU	//
						global $config;

						$this->db = mysqli_connect($config["host"],
																					 $config["user"],
																					 $config["pass"],
																					 $config["izen"]) or die("Error " . mysqli_error($this->db));
						if(!$this->db->connect_errno) {

								/*
								 * real_escape_string eta strip_tags HTML eta JS
								 * 'garbitu' egiten ditu kodigoa testu normal
								 * bihurtuz
								*/

								$izena = $this->db->real_escape_string(strip_tags($_POST['izena'], ENT_QUOTES));
								$abizena = $this->db->real_escape_string(strip_tags($_POST['abizena'], ENT_QUOTES));
								$email = $this->db->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
								$helbi = $this->db->real_escape_string(strip_tags($_POST['helbidea'], ENT_QUOTES));
								$pass = $_POST['pasahitza1'];
								$telf = $_POST['telefono'];

								//	password_hash PHP 5.3tik aurrera dabil	//

								//	Ausazko salt bat sortzen dugu pasahitzari segurtasuna gehitzeko	//

								$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

								$pass_hash = password_hash($pass.$salt, PASSWORD_DEFAULT);

								//	Emaila erabilpenean dagoen konprobatu	//

								$sql = "SELECT * FROM erabiltzaile WHERE email='".$email."';";
								$emailaErabilpenean = $this->db->query($sql);

								if($emailaErabilpenean->num_rows != 0) {
										$this->erroreak[] = "Emaila erabilpenean dago";
								} else {
										$sql = "INSERT INTO erabiltzaile
														(izena, abizena, email, helbidea, pasahitza_hash, pasahitza_salt, telefonoa)
														VALUES
														('".$izena."', '".$abizena."', '".$email."', '".$helbi."', '".$pass_hash."', '".$salt."', '".$telf."');";
										$inserzioa = $this->db->query($sql);

										//	Datuak sartu diren ala ez konprobatu	//

										if($inserzioa) {
											$this->mezuak[] = "Arrakastaz erregistratu zara.";
										} else {
											$this->erroreak[] = "Errorea izena ematean. Saia zaitez berriro".$salt;
										}

								}
						} else {
								$this->erroreak[] = "Errorea datubasera konektatzean";
						}
				}
		}
		private function erabiltzaileDatuakAldatu() {

			// EGITEKO...

		}
}
