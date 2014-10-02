<?php

class Erabiltzaile {
	public erroreak = array();
	public mezuak = array();
	
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
			$this->db = new mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			
			if(!$this->db->connect_errno) {
				$izena = $this->db->real_escape_string($_POST['izena']);
				$sql = "SELECT user_name, user_email, user_password_hash
						FROM erabiltzaileak
						WHERE user_name = '" . $izena . "' OR user_email = '" . $izena . "';";
				$existitzenbada = $this->db->query($sql);
				if($existitzenbada) {
					
				} else {
					$this->erroreak[] = "Izen edo email hori ez da existitzen.";
				}
			}
			
			
		}
	}
	private function atera() {
		session_destroy();
	}
	public function barruan() {
			
	}
}
