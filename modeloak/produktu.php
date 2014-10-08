<?php
class Produktu {
		
		private $db = null;
		
		public $erroreak = [];
		public $mezuak = [];
		
		/*
		 * Hemen CRUD funtzionalitate basikoa egongo da programatuta.
		 *        ^
		 * Create Read Update Delete
		 * 
		 * Datubasera queryak egiten dituen edozein funtziok pribatua
		 * izan behar du, eta kontrolatzailearen bidez abiaraziko degu.
		*/
		
		public function __construct() {
			
				/*
				 * Produktu->handle() Kontrolatzailea abiarazi.
				 * Web orrialdearen konplexutasuna haundituko balitz
				 * bat baino gehiago inplementatu daiteke.
				*/
				
				if(isset($_GET['ekintza'])) {
					$this->handle($_GET["ekintza"]);
				} else {
					$this->handle();
				}
		}
		
		private function handle($ekintza = null) {
			
			/* PRODUKTUEN KONTROLATZAILEA
			 * 
			 * GETaren arabera funtzio bat edo bestea egingo du.
			 * Hemen ere datubasera konexioa egiten dugu. Funtzionalitate
			 * orokor gehiago gehitu daitezke.
			 * 
			*/
			
			global $config;
			
			$this->db = mysqli_connect($config["host"],
															 $config["user"],
															 $config["pass"],
															 $config["izen"])
									or die("Error " . mysqli_error($this->db));
			
			switch($ekintza) {
				case "gehitu":
					$this->produktuaGehitu();
					break;
				case "kendu":
					$this->produktuaKendu();
					break;
				case "aldatu":
					$this->produktuaAldatu();
					break;
				case null:
					$this->produktuakErakutsi();
					break;
					
			}
		}
		
		private function produktuaGehitu() {
			if(Sartu::adminBarruan()) {
				
			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuaKendu() {
			if(Sartu::adminBarruan()) {
				
			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuaAldatu() {
			if(Sartu::adminBarruan()) {
				
			} else {
				$this->erroreak[] = "Ez zara kudeatzailea.";
			}
		}
		private function produktuakErakutsi($param = null) {
			
		}
}
