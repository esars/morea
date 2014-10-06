<?php
class Produktu {
		
		private $db = null;
		
		public $erroreak = new array();
		public $mezuak = new array();
		
		public function __construct() {
				if($_GET['produktua'] == "gehitu") {
						$this->produktuaGehitu();
				} else if($_GET['produktua'] == "kendu") {
						$this->produktuaKendu();
				} else if($_GET['produktua'] == "aldatu") {
						$this->produktuaAldatu();
				}
		}
				
		
		private function produktuaGehitu() {
			if(Sartu::adminBarruan()) {
				
			} else {
				$this->erroreak[] = "Ez zara kudeatzailea."
			}
		}
		private function produktuaKendu() {
			
		}
		private function produktuaAldatu() {
			
		}
		public static function produktuakErakutsi() {
			
		}
}
