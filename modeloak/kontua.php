<?php
class Kontua {
	
	/*
	 * Kontua klasea
	 * Erabiltzailearen datuak aldatzeaz arduratzen da,
	 * baita adminaren kudeatzailea abiarazteko. Beste 
	 * klase batzuen modura, handle funtzio bat izango du.
	*/
	
	private $db = null;
	
	public $erroreak = array();
	public $mezuak = array();
	
	public function __construct() {
		if(Sartu::barruan()) {
			$param = $_GET['kontua'];
			if isset($param) {
					$this->handle($param, Sartu::adminBarruan());
			}
		} else {
			$this->erroreak[] = "Ezin izan gara zure kontura sartu."
		}
	}
	private function handle($zer, $ad) {
		
		//~ KONTROLATZAILEA
		
		switch($zer) {
			case "datuakAldatu":
				include("bistak/datuak_aldatu.php");
				$this->datuakAldatu();
				break;
			case "pasahitzaAldatu":
				include("bistak/pasahitza_aldatu.php");
				$this->pasahitzaAldatu();
				break;
			case "kontuaBorratu":
				include("bistak/kontua_borratu.php");
				$this->kontuaBorratu();
				break;
			case "kontuakKudeatu":
				if($ad) {
					include("bistak/kontuak_kudeatu.php");
					$this->kontuakKudeatu();
					break;
				} else {
					$this->erroreak[] = "Ez zara kudeatzailea";
				}
				break;
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
}
